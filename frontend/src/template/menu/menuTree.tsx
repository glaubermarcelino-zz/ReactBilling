import React from 'react';

interface Props {
    icon: string,
    label: string
}

export const MenuTree: React.FC<Props> = ({ icon, label, children }) =>
    <li className="nav-item has-treeview">
        <a className="nav-link" onClick={e => e.preventDefault()}>
            <i className={`nav-icon fas fa-${icon}`}/>
            <p>
                {label}
                <i className="right fas fa-angle-left"/>
            </p>
        </a>
        <ul className="nav nav-treeview">
            {children}
        </ul>
    </li>;