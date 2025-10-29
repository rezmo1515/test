const StatusBadge = ({ tone = 'neutral', children }) => (
  <span className={`status-badge status-${tone}`}>{children}</span>
);

export default StatusBadge;
