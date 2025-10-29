const LoadingIndicator = ({ message = 'در حال بارگذاری...' }) => (
  <div className="empty-state" role="status">
    <span className="spinner" aria-hidden="true" />
    <p>{message}</p>
  </div>
);

export default LoadingIndicator;
