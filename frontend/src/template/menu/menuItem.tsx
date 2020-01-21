import React from 'react';
import { Link } from 'react-router-dom';

interface Props {
    path: string,
    icon: string,
    label: string
}

export const MenuItem: React.FC<Props> = ({ path, icon, label }) =>
    <li className="nav-item">
        <Link to={path} className="nav-link">
            <i className={`nav-icon fas fa-${icon}`}/>
            <p>{label}</p>
        </Link>
    </li>;