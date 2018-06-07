const textWidthCache = {};
const maxTextMeasureCacheLength = 200;

export default function measureTextWidth(context, text) {
  if (text.length > maxTextMeasureCacheLength) {
    return context.measureText(text).width;
  }

  const font = context.font;
  let textWidths;

  if (textWidthCache.hasOwnProperty(font) === false) {
    textWidthCache[font] = textWidths = new Map();
  } else {
    textWidths = textWidthCache[font];
  }

  let width = textWidths.get(text);

  if (width == null) {
    const length = text.length;

    width = 0;

    for (let i = 0; i < length; i++) {
      const char = text[i];

      let charWidth = textWidths.get(char);

      if (charWidth == null) {
        charWidth = context.measureText(char).width;
        textWidths.set(char, charWidth);
      }

      width += charWidth;
    }

    textWidths.set(text, width);
  }

  return width;
}
