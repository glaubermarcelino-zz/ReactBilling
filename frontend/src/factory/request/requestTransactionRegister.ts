import { Request } from './request';

export class RequestTransactionRegister extends Request {

    constructor(params: object) {
        let url = '/api/v1/transaction';
        let headers = { 'Content-Type' : 'application/x-www-form-urlencoded' };
        super(url, "POST", headers, params);
    }
}