import React from 'react';
import { withRouter } from 'react-router-dom';
import {LocalStorage} from "../../factory/localStorage";
import {Constants} from "../../constants";

interface Props {
    history: any
}

class Header extends React.PureComponent<Props> {

    render(): React.ReactNode {
        const user = LocalStorage.getObject(Constants.STORAGE_USER);
        return(
            <header className="main-header navbar navbar-expand navbar-white navbar-light">
                <ul className="navbar-nav">
                    <li className="nav-item">
                        <a className="nav-link" data-widget="pushmenu" href="/" onClick={e => e.preventDefault()}>
                            <i className="fas fa-bars"/>
                        </a>
                    </li>
                    <li className="nav-item d-sm-inline-block">
                        <a className="nav-link"  href="/" onClick={e => e.preventDefault()}>
                            {user.cpf}
                        </a>
                    </li>
                </ul>
                <ul className="navbar-nav ml-auto">
                    <li className="nav-item dropdown">
                        <button
                            className="btn nav-link"
                            onClick={() => {
                                LocalStorage.clear();
                                this.props.history.push("/");
                            }}
                        >
                            <i className="fas fa-power-off"/>
                        </button>
                    </li>
                </ul>
            </header>
        );
    }
}

export default withRouter<any, any>(Header);