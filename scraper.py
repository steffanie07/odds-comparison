import pymysql
from bs4 import BeautifulSoup
import requests

# Connect to your database
conn = pymysql.connect(host='127.0.0.1', user='root', password='root', db='local')

def scrape_odds(url, conn):
    headers = {'User-Agent': 'Mozilla/5.0'}
    response = requests.get(url, headers=headers)
    soup = BeautifulSoup(response.text, 'html.parser')

    odds = {}

    # Find table containing odds
    table = soup.find('table', {'class': 'eventTable'})
    if table is not None:
        rows = table.find_all('tr')
        for row in rows:
            cells = row.find_all('td')
            # Extract bookmaker and odds
            if len(cells) > 1:
                bookmaker = cells[0].get_text(strip=True)
                odds_value = cells[1].get_text(strip=True)
                odds[bookmaker] = odds_value

    # Insert the odds into the database
    with conn.cursor() as cursor:
        for bookmaker, odd in odds.items():
            sql = "INSERT INTO odds_comparison (bookmaker, odds) VALUES (%s, %s)"
            cursor.execute(sql, (bookmaker, odd))
    conn.commit()

url = 'https://www.oddschecker.com/football/world/brazil/serie-a/coritiba-v-fluminense/winner'  # Replace with your URL
scrape_odds(url, conn)
conn.close()
