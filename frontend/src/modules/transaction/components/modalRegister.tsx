import "react-datepicker/dist/react-datepicker.min.css";

import React from 'react';
import Select from 'react-select';
import DatePicker from 'react-datepicker';
import { connect } from "react-redux";
import { bindActionCreators, Dispatch } from "redux";
import { ApplicationState } from "../../../store";
import { Transaction, TransactionState } from "../../../store/ducks/transaction/types";
import * as TransactionActions from "../../../store/ducks/transaction/action";

import { Row, Grid  } from '../../../helpers';

interface StateProps {
    transaction: TransactionState
}

interface DispatchProps {
    accountRequest(): void,
    categoryRequest(id: number): void,
    transactionRegister(params: Transaction): void
}

interface OwnProps {
    type: number
}

type Props = StateProps & DispatchProps & OwnProps;

const INITIAL_STATE = {
    tag: "",
    name: "",
    note: "",
    value: "",
    account: null,
    category: null,
    fixed: false,
    date: new Date(),
    type: 0,
};

class ModalRegister extends React.PureComponent<Props, Transaction> {

    constructor(props: Props) {
        super(props);
        this.state = INITIAL_STATE
    }

    _registerTransaction(data: Transaction) {
        if(!data.account || !data.category)
            return false;
        data = {
            ...data,
            account: data.account.value,
            category: data.category.value
        };
        this.props.transactionRegister(data);
        this.setState(INITIAL_STATE);
    }

    componentDidMount(): void {
        $('#modal-register-transaction')
            .on('show.bs.modal', () => {
                this.props.accountRequest();
            })
            .on('shown.bs.modal', () => {
                this.props.categoryRequest(this.props.type);
                this.setState({ type: this.props.type });
            })
    }

    render(): React.ReactNode {
        const { type } = this.props;
        return(
            <div>
                <div className="modal fade" id="modal-register-transaction" aria-hidden="true">
                    <div className="modal-dialog">
                        <div className="modal-content">
                            <div className="modal-header">
                                <h4 className="modal-title">Nova {type === 1 ? "receita" : "despesa"}</h4>
                                <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div className="modal-body">
                                <form className="mb-3">
                                    <Row>
                                        <Grid cols="12 12 12 12 form-group">
                                            <label>Nome</label>
                                            <input
                                                id="name"
                                                type="text"
                                                placeholder="Nome"
                                                className={`form-control`}
                                                value={this.state.name}
                                                onChange={e => this.setState({name: e.target.value})}
                                            />
                                        </Grid>
                                    </Row>
                                    <Row>
                                        <Grid cols="6 6 6 6 form-group">
                                            <input
                                                id="value"
                                                type="text"
                                                placeholder="Valor"
                                                className={`form-control`}
                                                value={this.state.value}
                                                onChange={e => this.setState({value: e.target.value})}
                                            />
                                        </Grid>
                                        <Grid cols="6 6 6 6 form-group">
                                           <DatePicker
                                               className="form-control"
                                               selected={this.state.date}
                                               dateFormat="dd/MM/yyyy"
                                               onChange={date => this.setState({ date })}
                                           />
                                        </Grid>
                                    </Row>
                                    <Row>
                                        <Grid cols="6 6 6 6 form-group">
                                            <Select
                                                placeholder="Conta"
                                                value={this.state.account}
                                                options={this.props.transaction.account}
                                                onChange={e => this.setState({ account: e })}
                                                isLoading={this.props.transaction.isLoadingAccount}
                                            />
                                        </Grid>
                                        <Grid cols="6 6 6 6 form-group">
                                            <Select
                                                placeholder="Categoria"
                                                value={this.state.category}
                                                options={this.props.transaction.category}
                                                onChange={e => this.setState({ category: e })}
                                                isLoading={this.props.transaction.isLoadingCategory}
                                            />
                                        </Grid>
                                    </Row>
                                    <Row>
                                        <Grid cols="12 12 12 12 form-group">
                                            <input
                                                id="note"
                                                type="text"
                                                placeholder="Description"
                                                className={`form-control`}
                                                value={this.state.note}
                                                onChange={e => this.setState({note: e.target.value})}
                                            />
                                        </Grid>
                                    </Row>
                                    <Row>
                                        <Grid cols="12 12 12 12 form-group">
                                            <div className="form-check">
                                                <input
                                                    type="checkbox"
                                                    className="form-check-input"
                                                    checked={this.state.fixed}
                                                    onChange={e => this.setState({fixed: e.target.checked})}
                                                />
                                                <label className="form-check-label">Repetir</label>
                                            </div>
                                        </Grid>
                                    </Row>
                                </form>
                            </div>
                            <div className="modal-footer justify-content-between">
                                <button type="button" className="btn btn-default" data-dismiss="modal">Cancelar</button>
                                <button
                                    type="button"
                                    data-dismiss="modal"
                                    className="btn btn-dark"
                                    onClick={() => this._registerTransaction(this.state)}
                                >
                                   { this.props.transaction.isLoadingRegister ? 'Salvando...' : 'Salvar'}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }

}

const mapStateToProps = (state: ApplicationState) => ({
    transaction: state.transaction
});
const mapDispatchToProps = (dispatch: Dispatch) => bindActionCreators(TransactionActions, dispatch);

export default connect(mapStateToProps, mapDispatchToProps)(ModalRegister);