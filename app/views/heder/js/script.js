  
  function displayUserNameInElement(elementId) {
    const userName = localStorage.getItem('userName');
    if (userName) {
        const element = document.getElementById(elementId);
        element.textContent = `سلام، ${userName} !`;
    }
  }
  