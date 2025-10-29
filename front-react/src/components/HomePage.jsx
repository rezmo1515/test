import { useEffect, useState } from 'react';
import HeroSection from './sections/HeroSection.jsx';
import ServiceHighlights from './sections/ServiceHighlights.jsx';
import FeaturesTable from './sections/FeaturesTable.jsx';
import ApiStatus from './sections/ApiStatus.jsx';
import ContactBanner from './sections/ContactBanner.jsx';
import { fetchServices } from '../services/api.js';

const HomePage = () => {
  const [services, setServices] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    let mounted = true;
    fetchServices()
      .then((data) => {
        if (mounted) {
          setServices(data);
          setError(null);
        }
      })
      .catch(() => {
        if (mounted) {
          setError('اتصال به API با خطا روبه‌رو شد.');
        }
      })
      .finally(() => {
        if (mounted) {
          setLoading(false);
        }
      });

    return () => {
      mounted = false;
    };
  }, []);

  return (
    <div className="home-page">
      <HeroSection />
      <ServiceHighlights services={services} loading={loading} error={error} />
      <FeaturesTable />
      <ApiStatus loading={loading} error={error} />
      <ContactBanner />
    </div>
  );
};

export default HomePage;
