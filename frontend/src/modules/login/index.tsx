import './login.css';

import React from 'react';
import { connect } from 'react-redux';
import { ApplicationState } from "../../store";
import { bindActionCreators, Dispatch } from 'redux';
import { LoginState } from "../../store/ducks/login/types";
import * as LoginActions from "../../store/ducks/login/action";

import { LocalStorage } from "../../factory/localStorage";

interface State {
    email: string,
    password: string
}

interface StateProps {
    login: LoginState
}

interface DispatchProps {
    loginRequest(email: string, password: string): void
}

interface OwnProps { }

type Props = StateProps & DispatchProps & OwnProps;

class Login extends React.PureComponent<Props, State> {

    constructor(props: Props) {
        super(props);
        this.state = {
            email: "",
            password: ""
        }
    }

    componentDidMount(): void {
        LocalStorage.clear();
    }

    render(): React.ReactNode {
        const { login } = this.props;
        const { email, password } = this.state;
        return(
            <div className="login-page">
                <div className="login-box animated bounceInDown">
                    <div className="login-logo">
                        <a href="/"><b>Financial Control</b></a>
                    </div>
                    <div className="card">
                        <div className="card-body login-card-body">
                            <p className="login-box-msg">Faça login para iniciar sua sessão</p>
                            <form className="mb-3">
                                <div className="form-group">
                                    <input
                                        id="email"
                                        type="text"
                                        placeholder="E-mail"
                                        className={`form-control ${login.isError && 'is-invalid'}`}
                                        onChange={e => this.setState({email: e.target.value})}
                                        onKeyUp={e => e.key === 'Enter' && this.props.loginRequest(email, password)}
                                    />
                                </div>
                                <div className="form-group">
                                    <input
                                        id="password"
                                        type="password"
                                        placeholder="Senha"
                                        className={`form-control ${login.isError && 'is-invalid'}`}
                                        onChange={e => this.setState({password: e.target.value})}
                                        onKeyUp={e => e.key === 'Enter' && this.props.loginRequest(email, password)}
                                    />
                                    <div className="invalid-feedback">
                                        {login.isErrorMessage}
                                    </div>
                                </div>
                                <div className="row">
                                    <button
                                        type="button"
                                        onClick={() => this.props.loginRequest(email, password)}
                                        className="btn btn-primary btn-block ml-2 mr-2"
                                    >
                                        { login.isLoading ? '...' : 'Entrar'}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

const mapStateToProps = (state: ApplicationState) => ({
    login: state.login
});
const mapDispatchToProps = (dispatch: Dispatch) => bindActionCreators(LoginActions, dispatch);
export default connect(mapStateToProps, mapDispatchToProps)(Login);