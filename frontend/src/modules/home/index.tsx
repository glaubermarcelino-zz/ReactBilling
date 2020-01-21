import './home.css';

import React from 'react';
import { Link } from "react-router-dom";
import { connect } from 'react-redux';
import { ApplicationState } from "../../store";
import { bindActionCreators, Dispatch } from 'redux';
import { HomeState } from "../../store/ducks/home/types";
import * as HomeActions from "../../store/ducks/home/action";

import { Content, Grid, Row, SmallBox} from "../../helpers";

interface StateProps {
    home: HomeState
}

interface DispatchProps {
    accountRequest(): void,
    transactionDashRequest(date: string | Date): void
}

interface OwnProps { }

type Props = StateProps & DispatchProps & OwnProps;

class Home extends React.PureComponent<Props> {

    componentDidMount(): void {
        this.props.accountRequest();
        this.props.transactionDashRequest(new Date());
    }

    render(): React.ReactNode {
        const { account, isLoadingAccount, transactionDash, isLoadingTransactionDash } = this.props.home;
        return(
            <Content path="Home" title="Boa tarde, Giovane!">
                {
                   (account.length < 1 && !isLoadingAccount) && (
                        <Row className="pt-2">
                            <Grid cols="12">
                                <div className="text-center">
                                    Você ainda não possui uma conta! <Link to="/account">clique aqui.</Link>
                                </div>
                            </Grid>
                        </Row>
                    )
                }
                <Row className="pt-2">
                    <Grid cols="12">
                        <SmallBox
                            to="/account"
                            icon="wallet"
                            color="info"
                            desc="Total conta"
                            isLoading={isLoadingAccount}
                            value={`R$ ${account[0]?.sale || '0,00'}`}
                        />
                    </Grid>
                    <Grid cols="12">
                        <SmallBox
                            icon="money-bill-alt"
                            color="success"
                            desc="Total receita"
                            isLoading={isLoadingTransactionDash}
                            value={`R$ ${transactionDash.revenue}`}
                        />
                    </Grid>
                    <Grid cols="12">
                        <SmallBox
                            icon="money-check-alt"
                            color="danger"
                            desc="Total despesa"
                            isLoading={isLoadingTransactionDash}
                            value={`R$ ${transactionDash.expense}`}
                        />
                    </Grid>
                    <Grid cols="12">
                        <SmallBox
                            icon="university"
                            color="warning"
                            value={`R$ 0,00`}
                            desc="Total investido"
                            isLoading={isLoadingTransactionDash}
                        />
                    </Grid>
                </Row>
                <Row>
                    <Grid cols="4 4 4 4">
                        <div className="card">
                            <div className="card-header">
                                <h5>Accesso rapido</h5>
                            </div>
                            <div className="card-body">

                            </div>
                        </div>
                    </Grid>
                    <Grid cols="4 4 4 4">
                        <div className="card">
                            <div className="card-header">
                                <h5></h5>
                            </div>
                            <div className="card-body p-0">

                            </div>
                        </div>
                    </Grid>
                    <Grid cols="4 4 4 4">
                        <div className="card">
                            <div className="card-header">
                                <h5></h5>
                            </div>
                            <div className="card-body p-0">

                            </div>
                        </div>
                    </Grid>
                </Row>
            </Content>
        );
    }
}

const mapStateToProps = (state: ApplicationState) => ({
    home: state.home
});
const mapDispatchToProps = (dispatch: Dispatch) => bindActionCreators(HomeActions, dispatch);

export default connect(mapStateToProps, mapDispatchToProps)(Home);