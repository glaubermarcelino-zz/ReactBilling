import { ReactElement} from 'react';

interface Props {
    test: any,
    children: ReactElement
}

export const IfRender = ({ test, children }: Props) => test ? children : null;