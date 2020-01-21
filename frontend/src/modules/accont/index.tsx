import './account.css';

import React from 'react';
import { connect } from 'react-redux';
import { ApplicationState } from "../../store";
import { bindActionCreators, Dispatch } from 'redux';
import { AccountState } from "../../store/ducks/account/types";
import * as AccountActions from "../../store/ducks/account/action";

import { Content, Grid, Row} from "../../helpers";
import ModalRegister from './components/modalRegister';

interface StateProps {
    account: AccountState
}

interface DispatchProps {
    accountRequest(): void
}

interface OwnProps { }

type Props = StateProps & DispatchProps & OwnProps;

class Account extends React.PureComponent<Props> {

    componentDidMount(): void {
        this.props.accountRequest();
    }

    render(): React.ReactNode {
        const { account, isLoadingAccount } = this.props.account;
        return(
            <Content path="Conta" title="Conta">
                <Row className="pt-2">
                    <Grid cols="4 4 4 4">
                        <div className="card">
                            <div className="card-header">
                                <h3 className="card-title">Suas contas</h3>
                                <div className="card-tools">
                                    {
                                        account.length <= 0 && (
                                            <React.Fragment>
                                                <ModalRegister />
                                                <a
                                                    href="/"
                                                    data-toggle="modal"
                                                    className="btn btn-tool"
                                                    onClick={e => e.preventDefault()}
                                                    data-target="#modal-register-account"
                                                >
                                                    <i className="fas fa-plus"/>
                                                </a>
                                            </React.Fragment>
                                        )
                                    }

                                </div>
                            </div>
                            <div className="card-body p-0">
                                <table className="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Saldo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {
                                            account.length > 0 ?
                                                account.map(item =>
                                                    <tr key={item.id}>
                                                        <td>{item.name}</td>
                                                        <td>{item?.sale || 0}</td>
                                                    </tr>
                                                )
                                            :
                                                <tr>
                                                    <td colSpan={6} align="center">
                                                        {
                                                            isLoadingAccount ?
                                                                <i className="fas fa-spin fa-circle-notch" />
                                                            :
                                                                <span>Nenhuma conta disponivel!</span>
                                                        }
                                                    </td>
                                                </tr>
                                        }
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </Grid>
                    <Grid cols="8 8 8 8">

                    </Grid>
                </Row>
            </Content>
        )
    }

}

const mapStateToProps = (state: ApplicationState) => ({
    account: state.account
});
const mapDispatchToProps = (dispatch: Dispatch) => bindActionCreators(AccountActions, dispatch);

export default connect(mapStateToProps, mapDispatchToProps)(Account);