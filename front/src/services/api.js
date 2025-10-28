import axios from 'axios';

const baseURL = import.meta?.env?.VITE_API_BASE_URL || '/api';

const client = axios.create({
  baseURL,
  timeout: 10000,
  headers: {
    'Content-Type': 'application/json',
    Accept: 'application/json'
  }
});

export const setAuthToken = (token) => {
  if (token) {
    client.defaults.headers.common.Authorization = `Bearer ${token}`;
  } else {
    delete client.defaults.headers.common.Authorization;
  }
};

const resolvePayload = (response) => {
  const payload = response.data;
  if (payload?.status === 'success') {
    return payload.data ?? [];
  }
  if (Array.isArray(payload)) {
    return payload;
  }
  if (payload?.data) {
    return payload.data;
  }
  return payload;
};

const normalizeError = (error) => {
  if (error.response?.data?.message) {
    return new Error(error.response.data.message);
  }
  if (typeof error.message === 'string') {
    return new Error(error.message);
  }
  return new Error('خطای نامشخصی رخ داده است');
};

export const loginRequest = async (credentials) => {
  try {
    const response = await client.post('/auth/login', credentials);
    const payload = response.data;
    if (payload?.status === 'success') {
      return payload.data;
    }
    throw new Error(payload?.message || 'ورود ناموفق بود');
  } catch (error) {
    throw normalizeError(error);
  }
};

export const logoutRequest = async () => {
  try {
    await client.post('/auth/logout');
  } catch (error) {
    throw normalizeError(error);
  }
};

export const fetchEmployees = async (filters = {}) => {
  try {
    const response = await client.get('/employees', { params: filters });
    return resolvePayload(response);
  } catch (error) {
    throw normalizeError(error);
  }
};

export const fetchDepartments = async (filters = {}) => {
  try {
    const response = await client.get('/departments', { params: filters });
    return resolvePayload(response);
  } catch (error) {
    throw normalizeError(error);
  }
};

export default client;
