// PACKAGES
import React from 'react';
import { createRoot } from 'react-dom/client';
// CSS
import '~/src/client/css/vcenter.css';
// COMPONENTS (A-Z)
import Root from '~/src/client/components/root.jsx';

if (document.getElementById('root')) {
  const data = JSON.parse(document.getElementById('root').getAttribute('data'));
  const container = document.getElementById('root');
  const root = createRoot(container);
  root.render(<Root data={data} />);
}
