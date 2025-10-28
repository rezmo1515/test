import { createContext, useCallback, useContext, useEffect, useMemo, useState } from 'react';
import { loginRequest, logoutRequest, setAuthToken } from '../services/api.js';

const AuthContext = createContext({});

const storage = typeof window !== 'undefined' ? window.localStorage : null;
const storageKey = 'mobin-host-token';
const userKey = 'mobin-host-user';

const readStorage = (key, fallback = null) => {
  if (!storage) return fallback;
  try {
    return storage.getItem(key);
  } catch (error) {
    return fallback;
  }
};

const writeStorage = (key, value) => {
  if (!storage) return;
  try {
    storage.setItem(key, value);
  } catch (error) {
    // ignore storage write failures
  }
};

const removeStorage = (key) => {
  if (!storage) return;
  try {
    storage.removeItem(key);
  } catch (error) {
    // ignore storage removal failures
  }
};

export const AuthProvider = ({ children }) => {
  const [token, setToken] = useState(() => readStorage(storageKey));
  const [user, setUser] = useState(() => {
    const stored = readStorage(userKey);
    return stored ? JSON.parse(stored) : null;
  });
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState('');

  useEffect(() => {
    setAuthToken(token);
    if (!token) {
      setUser(null);
      removeStorage(storageKey);
      removeStorage(userKey);
    }
  }, [token]);

  const login = useCallback(async (credentials) => {
    setLoading(true);
    setError('');
    try {
      const payload = await loginRequest(credentials);
      const nextToken = payload.token;
      const nextUser = payload.user;
      setToken(nextToken);
      setUser(nextUser);
      writeStorage(storageKey, nextToken);
      writeStorage(userKey, JSON.stringify(nextUser));
      return true;
    } catch (err) {
      setError(err.message || 'ورود انجام نشد');
      return false;
    } finally {
      setLoading(false);
    }
  }, []);

  const logout = useCallback(async () => {
    try {
      await logoutRequest();
    } catch (error) {
      // ignore API failures during logout
    }
    setToken(null);
    setUser(null);
    removeStorage(storageKey);
    removeStorage(userKey);
  }, []);

  const value = useMemo(() => ({ token, user, login, logout, loading, error, setError }), [
    token,
    user,
    login,
    logout,
    loading,
    error
  ]);

  return <AuthContext.Provider value={value}>{children}</AuthContext.Provider>;
};

export const useAuth = () => useContext(AuthContext);
