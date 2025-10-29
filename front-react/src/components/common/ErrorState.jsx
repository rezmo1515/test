const ErrorState = ({ message = 'خطایی رخ داده است', onRetry }) => (
  <div className="empty-state" role="alert">
    <p>{message}</p>
    {onRetry && (
      <button type="button" className="secondary-button" onClick={onRetry}>
        تلاش مجدد
      </button>
    )}
  </div>
);

export default ErrorState;
