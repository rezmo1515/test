import { useEffect, useState } from 'react';
import HeroSection from './sections/HeroSection.jsx';
import ServiceHighlights from './sections/ServiceHighlights.jsx';
import FeaturesTable from './sections/FeaturesTable.jsx';
import ApiStatus from './sections/ApiStatus.jsx';
import ContactBanner from './sections/ContactBanner.jsx';
import { fetchFeatureMatrix, fetchServices } from '../services/api.js';

const HomePage = () => {
  const [services, setServices] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);
  const [featureRows, setFeatureRows] = useState([]);
  const [featuresLoading, setFeaturesLoading] = useState(true);
  const [featureError, setFeatureError] = useState('');

  useEffect(() => {
    let mounted = true;
    const loadServices = async () => {
      try {
        const data = await fetchServices();
        if (mounted) {
          setServices(Array.isArray(data) ? data : []);
          setError(null);
        }
      } catch (err) {
        if (mounted) {
          setError(err.message || 'اتصال به API با خطا روبه‌رو شد.');
        }
      } finally {
        if (mounted) {
          setLoading(false);
        }
      }
    };

    const loadFeatures = async () => {
      try {
        const data = await fetchFeatureMatrix();
        if (mounted) {
          setFeatureRows(Array.isArray(data) ? data : []);
          setFeatureError('');
        }
      } catch (err) {
        if (mounted) {
          setFeatureError(err.message || 'دریافت ویژگی‌ها با خطا روبه‌رو شد.');
        }
      } finally {
        if (mounted) {
          setFeaturesLoading(false);
        }
      }
    };

    loadServices();
    loadFeatures();

    return () => {
      mounted = false;
    };
  }, []);

  const overallLoading = loading || featuresLoading;
  const overallError = error || featureError || null;

  return (
    <div className="home-page">
      <HeroSection />
      <ServiceHighlights services={services} loading={loading} error={error} />
      <FeaturesTable rows={featureRows} loading={featuresLoading} error={featureError} />
      <ApiStatus loading={overallLoading} error={overallError} />
      <ContactBanner />
    </div>
  );
};

export default HomePage;
