<style>
    /* Spinner container */
.spinner-container {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1061;
}

/* Spinner */
.spinner {
  border: 4px solid rgba(255, 255, 255, 0.3);
  border-top-color: #00f334;
  border-radius: 50%;
  width: 40px;
  height: 40px;
  animation: spin 1s ease-in-out infinite;
}

/* Spinner animation */
@keyframes spin {
  0% {
    transform: rotate(0);
  }
  100% {
    transform: rotate(360deg);
  }
}

</style>

<div class="spinner-container" style="display: none;">
    <div class="spinner"></div>
</div>