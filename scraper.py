import pymysql
from bs4 import BeautifulSoup
import requests

# Connect to your database
conn = pymysql.connect(host='', user='', password='', db='')

def scrape_odds(urls, markets, conn):
    headers = {'User-Agent': 'Mozilla/5.0'}
    odds_data = []

    for url in urls:
        response = requests.get(url, headers=headers)
        soup = BeautifulSoup(response.text, 'html.parser')

        table = soup.find('table', {'class': 'eventTable'})
        if table is not None:
            rows = table.find_all('tr')
            for row in rows:
                cells = row.find_all('td')
                # Extract bookmaker and odds
                if len(cells) > 1:
                    bookmaker = cells[0].get_text(strip=True)
                    odds_value = cells[1].get_text(strip=True)
                    odds_data.append((url, markets, bookmaker, odds_value))

    with conn.cursor() as cursor:
        for url, market, bookmaker, odd in odds_data:
            sql = "INSERT INTO odds_comparison (url, market, bookmaker, odds) VALUES (%s, %s, %s, %s)"
            cursor.execute(sql, (url, market, bookmaker, odd))
    conn.commit()

urls = [
    'https://www.oddschecker.com/football/world/brazil/serie-a/coritiba-v-fluminense/winner',
    # Add more URLs here...
]

markets = 'Serie A'  # Change this to the appropriate market for all URLs

# Scrape odds for the provided URLs and markets
scrape_odds(urls, markets, conn)

conn.close()
