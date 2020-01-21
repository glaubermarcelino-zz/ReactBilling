import { Request } from './request';

export class RequestTransactionFIlterList extends Request {

    constructor(params: object) {
        let url = '/api/v1/transaction/filter';
        let headers = { 'Content-Type' : 'application/x-www-form-urlencoded' };
        super(url, "POST", headers, params);
    }
}