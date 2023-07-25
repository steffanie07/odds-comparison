import { InspectorControls, useBlockProps } from '@wordpress/block-editor';
import { PanelBody, SelectControl } from '@wordpress/components';
import { useEffect, useState } from '@wordpress/element';
import { __ } from '@wordpress/i18n';

function toDecimal(odd) {
    console.log('toDecimal input:', odd);
    const [numerator, denominator] = odd.split('/').map(Number);
    console.log('Numerator:', numerator, 'Denominator:', denominator);
    return numerator / denominator + 1;
}

function toAmerican(decimal) {
    if (decimal >= 2.0) {
        return "+" + Math.round((decimal - 1) * 100);
    } else {
        return "-" + Math.round((1 / decimal - 1) * 100);
    }
}
function toFractional(decimal) {
    let numerator = Math.floor(decimal - 1);
    let denominator = 1;
    
    while (numerator % 2 === 0 && denominator % 2 === 0) {
        numerator /= 2;
        denominator /= 2;
    }
    
    return `${numerator}/${denominator}`;
}



export default function Edit({ attributes, setAttributes }) {
    const blockProps = useBlockProps();
    const [ oddsData, setOddsData ] = useState(null);
    const [ bookmakers, setBookmakers ] = useState([]);
	const [ selectedBookmakers, setSelectedBookmakers ] = useState(
		attributes.selectedBookmakers ? JSON.parse(attributes.selectedBookmakers) : []
	);
	
    useEffect(() => {
        fetch('/wp-json/odds/v1/odds')
            .then(response => response.json())
            .then(data => {
                setOddsData(data);
            });

        fetch('/wp-json/odds/v1/bookmakers')
            .then(response => response.json())
            .then(data => {
                setBookmakers(data);
            });
    }, []);
    
	const handleBookmakersChange = (selected) => {
        setSelectedBookmakers(selected);
        setAttributes({ selectedBookmakers: JSON.stringify(selected) }); 
    }
    return (
  <div { ...blockProps }>
    <InspectorControls key="setting">
        <PanelBody title={ __( 'Odds Comparison Settings' ) }>
		<SelectControl
                        multiple
                        label={ __( 'Bookmakers' ) }
                        value={ selectedBookmakers }
                        options={ bookmakers.map(bookmaker => ({ value: bookmaker.id, label: bookmaker.bookmaker })) }
                        onChange={ handleBookmakersChange }
                    />
            <SelectControl
                label={ __( 'Odds Format' ) }
                value={ attributes.oddsFormat }
                options={ [
                    { value: 'fractional', label: 'Fractional' },
                    { value: 'decimal', label: 'Decimal' },
                    { value: 'american', label: 'American' },
                ] }
                onChange={ ( value ) => setAttributes( { oddsFormat: value } ) }
            />
        </PanelBody>
    </InspectorControls>

    {oddsData ? 
        selectedBookmakers.length > 0 ?
            <table>
                <thead>
                    <tr>
                        <th>Bookmaker</th>
                        <th>Odds</th>
                    </tr>
                </thead>
                <tbody>
                    {selectedBookmakers.map(bookmakerId => {
                        const bookmaker = oddsData.find(odd => odd.bookmaker === bookmakerId);
                        if (bookmaker) {
                            let displayOdd;
							switch (attributes.oddsFormat) {
								case 'decimal':
									displayOdd = bookmaker.odds;
									break;
								case 'american':
									displayOdd = toAmerican(Number(bookmaker.odds)); // ensure odds is a number
									break;
								case 'fractional':
									displayOdd = toFractional(Number(bookmaker.odds)); // convert to fractional
									break;
								default:
									displayOdd = bookmaker.odds;
							}
							
                            return (
                                <tr key={bookmakerId}>
                                    <td>{bookmaker.bookmaker}</td>
                                    <td>{displayOdd}</td>
                                </tr>
                            );
                        }
                        return null;
                    })}
                </tbody>
            </table> :
            <p>No bookmakers selected</p>
        :
        'Loading...'
    }
</div>

    )
}
