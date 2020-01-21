import React from 'react';

interface Props {
    cols: string,
    style?: object
}

export const Grid: React.FC<Props> = ({ cols, style, children }) => {
    const gridClasses = (numbers: string) => {
        const cols = numbers ? numbers.split(' ') : [];
        let classes = '';
        if (cols[0]) classes += `col col-xs-${cols[0]}`;
        if (cols[1]) classes += ` col-sm-${cols[1]}`;
        if (cols[2]) classes += ` col-md-${cols[2]}`;
        if (cols[3]) classes += ` col-lg-${cols[3]}`;
        if (cols[4]) classes += ` ${cols[4]}`;
        return classes;
    };
    return(
        <div
            className={
                gridClasses(cols || '12')
            }
            style={style}
        >
            { children }
        </div>
    );
};
