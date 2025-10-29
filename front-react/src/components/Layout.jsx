import Header from './navigation/Header.jsx';
import Footer from './navigation/Footer.jsx';

const Layout = ({ children }) => (
  <div className="app-shell">
    <Header />
    <main className="app-main">{children}</main>
    <Footer />
  </div>
);

export default Layout;
