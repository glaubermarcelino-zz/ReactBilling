import './transaction.css';

import React from 'react';
import Select from 'react-select';
import { connect } from 'react-redux';
import { ApplicationState } from "../../store";
import { bindActionCreators, Dispatch } from 'redux';
import { TransactionState } from "../../store/ducks/transaction/types";
import * as TransactionActions from "../../store/ducks/transaction/action";

import { Content, Grid, Row } from "../../helpers";
import ModalRegister from './components/modalRegister';

interface StateProps {
    transaction: TransactionState
}

interface DispatchProps {
   transactionRequest(date: string | Date, type?: number, category?: number): void,
}

interface OwnProps {

}

interface State {
    type: number,
}


type Props = StateProps & DispatchProps & OwnProps;

class Transaction extends React.PureComponent<Props, State> {

    constructor(props: Props) {
        super(props);
        this.state = {
            type: 0
        }
    }

    componentDidMount(): void {
        this.props.transactionRequest(new Date());
    }

    render(): React.ReactNode {
        const { transaction } = this.props;
        return(
            <Content path="Transação" title="Transação">
                <Row className="pt-3">
                    <Grid cols="12">
                        <div className="card">
                            <Row className="card-body d-flex align-items-center justify-content-between">
                                <Grid cols="4 4 4 4">
                                    <ModalRegister
                                        type={this.state.type}
                                    />
                                    <button
                                        onClick={() => this.setState({ type: 1 })}
                                        data-toggle="modal"
                                        data-target="#modal-register-transaction"
                                        className="btn btn-outline-success rounded-circle float-left"
                                    >
                                        <i className="fas fa-plus"/>
                                    </button>
                                    <button
                                        onClick={() => this.setState({ type: 2 })}
                                        data-toggle="modal"
                                        data-target="#modal-register-transaction"
                                        className="btn btn-outline-danger rounded-circle float-left ml-2"
                                    >
                                        <i className="fas fa-minus"/>
                                    </button>
                                </Grid>
                               <Grid cols="4 4 4 4">
                                    <Select

                                    />
                               </Grid>
                                <Grid cols="4 4 4 4">
                                    <button className="btn btn-outline-dark rounded-circle float-right">
                                        <i className="fas fa-filter"/>
                                    </button>
                                </Grid>
                            </Row>
                        </div>
                    </Grid>
                </Row>
                <Row>
                    <Grid cols="12">
                        <div className="card">
                            <div className="card-body p-0">
                                <table className="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Tipo</th>
                                            <th>Categoria</th>
                                            <th>Valor</th>
                                            <th>Data</th>
                                            <th>Conta</th>
                                            <th>Descrição</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    {
                                        transaction.transactions.map(item =>
                                            <tr key={item.id}>
                                                <td>{item.name}</td>
                                                <td>{item.type}</td>
                                                <td>{item.category}</td>
                                                <td>{item.value}</td>
                                                <td>{item.date}</td>
                                                <td>{item.account}</td>
                                                <td>{item.note}</td>
                                            </tr>
                                        )
                                    }
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </Grid>
                </Row>
            </Content>
        );
    }

}

const mapStateToProps = (state: ApplicationState) => ({
    transaction: state.transaction
});
const mapDispatchToProps = (dispatch: Dispatch) => bindActionCreators(TransactionActions, dispatch);

export default connect(mapStateToProps, mapDispatchToProps)(Transaction);