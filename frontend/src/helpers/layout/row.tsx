import React from 'react';

interface Props {
    className?: string
}

export const Row: React.FC<Props> = props =>
    <div {...props} className={`row ${props.className}`}>
        {props.children}
    </div>;

