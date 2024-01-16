// PACKAGES
import React from 'react';
import { render } from 'react-dom';
// CSS
import '~/src/client/css/vcenter.css';
// COMPONENTS (A-Z)
import Root from '~/src/client/components/root.jsx';

if (document.getElementById('root')) {
  const data = JSON.parse(document.getElementById('root').getAttribute('data'));
  render(
    <Root data={data} />,
    document.getElementById('root')
  );
}
