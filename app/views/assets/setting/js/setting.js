document.addEventListener("DOMContentLoaded", function() {
  loadFontSettings();
  document.getElementById('fontForm').addEventListener('submit', function(event) {
      event.preventDefault();
      saveFontSettings();
  });
});
function saveFontSettings() {
  const fontSettings = {
      fontname: document.getElementById('fontname').value,
      fontsize: document.getElementById('fontsize').value
  };
  localStorage.setItem('fontSettings', JSON.stringify(fontSettings));
  alert("تنظیمات فونت ذخیره شد");
  window.location.reload();
}

function loadFontSettings() {
  const fontSettings = JSON.parse(localStorage.getItem('fontSettings'));
  if (fontSettings) {
      document.getElementById('fontname').value = fontSettings.fontname;
      document.getElementById('fontsize').value = fontSettings.fontsize;
  }
}

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
      }
  }
}
function applyFontSettings() {
  const fontSettings = JSON.parse(localStorage.getItem('fontSettings'));
  if (fontSettings) {
      if (fontSettings.fontname) {
          document.body.style.fontFamily = fontSettings.fontname;
          const inputs = document.querySelectorAll('input, select, textarea,button');
          inputs.forEach(input => {
              input.style.fontFamily = fontSettings.fontname;
          });
      }
      if (fontSettings.fontsize) {
          const fontSize = parseInt(fontSettings.fontsize, 10);
          document.body.style.fontSize = fontSize + 'px';
          const inputs = document.querySelectorAll('input, select, textarea');
          inputs.forEach(input => {
              input.style.fontSize = fontSize + 'px';
          });
        }
      }}
