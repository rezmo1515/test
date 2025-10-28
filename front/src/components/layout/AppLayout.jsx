import { useMemo } from 'react';
import Header from './Header.jsx';
import Sidebar from './Sidebar.jsx';
import { useAuth } from '../../context/AuthContext.jsx';

const AppLayout = ({ children, pageTitle }) => {
  const { user } = useAuth();

  const breadcrumbs = useMemo(() => [
    { label: 'خانه', href: '/employees' },
    { label: pageTitle, href: null }
  ], [pageTitle]);

  return (
    <div className="app-shell">
      <Sidebar active="employees" user={user} />
      <div className="app-content">
        <Header breadcrumbs={breadcrumbs} pageTitle={pageTitle} user={user} />
        <main className="app-main" role="main">
          {children}
        </main>
      </div>
    </div>
  );
};

export default AppLayout;
