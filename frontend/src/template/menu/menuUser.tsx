import React from 'react';

import User from '../../assets/user.png';

interface Props {
    user: any
}

export const MenuUser: React.FC<Props> = ({ user }) =>
    <div className="user-panel mt-3 pb-3 mb-3 d-flex">
        <div className="image">
            <img src={User} className="img-circle elevation-2" alt="User"/>
        </div>
        <div className="info">
            <a href="/" onClick={e => e.preventDefault()} className="d-block">{user.name}</a>
        </div>
    </div>;
