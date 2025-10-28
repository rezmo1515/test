import axios from 'axios';

const client = axios.create({
  baseURL: '/api',
  timeout: 8000,
  headers: {
    'Content-Type': 'application/json',
    Accept: 'application/json'
  }
});

export const fetchServices = async () => {
  try {
    const response = await client.get('/services');
    if (Array.isArray(response.data)) {
      return response.data;
    }
    if (response.data?.data) {
      return response.data.data;
    }
    return [];
  } catch (error) {
    if (error.response?.data?.message) {
      throw new Error(error.response.data.message);
    }
    throw error;
  }
};

export const fetchPlans = async () => {
  const response = await client.get('/plans');
  return Array.isArray(response.data) ? response.data : response.data?.data || [];
};

export default client;
