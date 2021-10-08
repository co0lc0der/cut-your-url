document.addEventListener('DOMContentLoaded', () => {
  const clipboard = new ClipboardJS('.copy-btn');
  const myToastEl = document.querySelector('.toast');
  const toastText = myToastEl.querySelector('.toast-body');

  clipboard.on('success', (e) => {
    toastText.textContent = `Ссылка '${e.text}' скопирована в буфер`;

    const myToast = new bootstrap.Toast(myToastEl);
    myToast.show();

    e.clearSelection();
  });
});
