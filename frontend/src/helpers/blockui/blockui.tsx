import React from "react";

interface Props {
    color: string
}

export const BlockUI: React.FC<Props> = ({ color }) =>
    <div className={`overlay ${color}`}>
        <i className="fas fa-spin fa-3x fa-circle-notch"/>
    </div>;