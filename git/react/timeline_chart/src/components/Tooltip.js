import React from 'react';
import { Style, StyleRoot } from 'radium';

export default  function Tooltip({ entry, styles }) {
  return (
    <StyleRoot>
      <Style scopeSelector='.tooltip'
             rules={styles.tooltip}/>
      <div className='tooltip'>
        <b>{entry.end - entry.start} ms</b> {entry.name}
      </div>
    </StyleRoot>
  );
}
