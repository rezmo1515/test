import { useEffect, useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { useAuth } from '../context/AuthContext.jsx';

const LoginPage = () => {
  const navigate = useNavigate();
  const { login, loading, error, setError, token } = useAuth();
  const [formData, setFormData] = useState({ username: '', password: '', remember: true });

  useEffect(() => {
    if (token) {
      navigate('/employees', { replace: true });
    }
  }, [token, navigate]);

  const handleChange = (event) => {
    const { name, value, type, checked } = event.target;
    setFormData((prev) => ({
      ...prev,
      [name]: type === 'checkbox' ? checked : value
    }));
    if (error) {
      setError('');
    }
  };

  const handleSubmit = async (event) => {
    event.preventDefault();
    const success = await login(formData);
    if (success) {
      navigate('/employees', { replace: true });
    }
  };

  return (
    <div className="auth-screen">
      <div className="auth-card">
        <div className="auth-brand">
          <span className="brand-logo" aria-hidden="true">M</span>
          <h1>سامانه مدیریت منابع انسانی مبین هاست</h1>
          <p>برای ادامه وارد حساب مدیریتی خود شوید.</p>
        </div>
        <form className="auth-form" onSubmit={handleSubmit}>
          <label>
            نام کاربری
            <input
              type="text"
              name="username"
              value={formData.username}
              onChange={handleChange}
              autoComplete="username"
              required
            />
          </label>
          <label>
            کلمه عبور
            <input
              type="password"
              name="password"
              value={formData.password}
              onChange={handleChange}
              autoComplete="current-password"
              required
            />
          </label>
          <label className="remember-field">
            <input
              type="checkbox"
              name="remember"
              checked={formData.remember}
              onChange={handleChange}
            />
            مرا به خاطر بسپار
          </label>
          {error && <p className="form-error" role="alert">{error}</p>}
          <button type="submit" className="primary-button" disabled={loading}>
            {loading ? 'در حال ورود...' : 'ورود به سامانه'}
          </button>
        </form>
        <footer className="auth-footer">© {new Date().getFullYear()} Mobin Host</footer>
      </div>
    </div>
  );
};

export default LoginPage;
