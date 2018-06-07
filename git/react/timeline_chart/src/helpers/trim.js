import measureTextWidth from './measureTextWidth';

export function trimTextMiddle(context, text, maxWidth) {
  return trimText(context, text, maxWidth, trimMiddle);
}

export function trimMiddle(text, maxLength) {
  const length = text.length;

  if (length <= maxLength) {
    return text;
  }

  const left = maxLength / 2;

  return text.substr(0, left) + '\u2026' + text.substr(length - left + 1);
}

export function trimText(context, text, maxWidth, trimFunction) {
  const maxLength = 200;

  if (maxWidth <= 10) {
    return '';
  }

  if (text.length > maxLength) {
    text = trimFunction(text, maxLength);
  }

  const textWidth = measureTextWidth(context, text);

  if (textWidth <= maxWidth) {
    return text;
  }

  let l = 0;
  let r = text.length;
  let lv = 0;
  let rv = textWidth;

  while (l < r && lv !== rv && lv !== maxWidth) {
    const m = Math.ceil(l + (r - l) * (maxWidth - lv) / (rv - lv));
    const mv = measureTextWidth(context, trimFunction(text, m));
    if (mv <= maxWidth) {
      l = m;
      lv = mv;
    } else {
      r = m - 1;
      rv = mv;
    }
  }

  text = trimFunction(text, l);

  return text !== '\u2026' ? text : '';
}