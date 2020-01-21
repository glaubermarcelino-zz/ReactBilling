import React from 'react';

interface Props {
    title?: string,
    path?: string
}

export const Content: React.FC<Props> = ({ title, path, children }) =>
    <section className="content-header">
        <div className="container-fluid">
            <div className="row mb-2">
                <div className="col-sm-6">
                    <h1 className="m-0 text-dark">{title}</h1>
                </div>
                <div className="col-sm-6">
                    <ol className="breadcrumb float-sm-right">
                        <li className="breadcrumb-item"><a href="#">App</a></li>
                        <li className="breadcrumb-item active">{path}</li>
                    </ol>
                </div>
            </div>
        </div>
        <div className="content">
            <div className="container-fluid">
                {children}
            </div>
        </div>
    </section>;