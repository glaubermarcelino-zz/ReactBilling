import React from 'react';
import { BlockUI } from "..";
import { Link } from "react-router-dom";

interface Props {
    to?: string,
    color: string,
    value: any,
    desc: string,
    icon: string,
    isLoading?: boolean
}

export const SmallBox: React.FC<Props> = ({ isLoading, color, icon, value, desc, to }) =>
    <div className={`small-box bg-${color}`}>
        { isLoading && <BlockUI color="dark" /> }
        <div className="inner">
            <h3>{value}</h3>
            <p>{desc}</p>
        </div>
        <div className="icon">
            <i className={`fas fa-${icon}`}/>
        </div>
        <Link to={to || '/home'}  className="small-box-footer">
            More info <i className="fas fa-arrow-circle-right"/>
        </Link>
    </div>;