// PACKAGES
import React from 'react';
import { createRoot } from 'react-dom/client';
// CSS
import '~/src/client/css/vcenter.css';
// COMPONENTS (A-Z)
import Root from '~/src/client/components/root.jsx';
import Login from '~/src/client/components/login.jsx';

if (document.getElementById('root')) {
  const container = document.getElementById('root');
  const data = JSON.parse(container.getAttribute('data'));
  const root = createRoot(container);
  root.render(<Root data={data} />);
}

if (document.getElementById('login')) {
  const container = document.getElementById('login');
  const data = JSON.parse(container.getAttribute('data'));
  const root = createRoot(container);
  root.render(<Login data={data} />);
}
