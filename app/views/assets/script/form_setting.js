document.addEventListener("DOMContentLoaded", function() {
  applyFontSettings();
});

function applyFontSettings() {
  const fontSettings = JSON.parse(localStorage.getItem('fontSettings'));
  if (fontSettings) {
      if (fontSettings.fontname) {
          document.body.style.fontFamily = fontSettings.fontname;
      }
      if (fontSettings.fontsize) {
          const fontSize = parseInt(fontSettings.fontsize, 10);
          document.body.style.fontSize = fontSize + 'px';

          const headers = document.querySelectorAll('h1, h2, h3, h4, h5, h6');
          headers.forEach(header => {
              header.style.fontSize = (fontSize + 8) + 'px';
          });

          const buttons = document.querySelectorAll('button, input[type="button"], input[type="submit"], select');
          buttons.forEach(element => {
              element.style.fontFamily = fontSettings.fontname;
              element.style.fontSize = fontSize + 'px';
          });
      }
  }
}
   