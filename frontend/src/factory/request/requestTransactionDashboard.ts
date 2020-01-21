import { Request } from './request';

export class RequestTransactionDashboard extends Request {

    constructor(date: string | Date) {
        let url = '/api/v1/transaction/dashboard';
        let headers = { 'Content-Type' : 'application/x-www-form-urlencoded' };
        let params = { date };
        super(url, "POST", headers, params);
    }
}