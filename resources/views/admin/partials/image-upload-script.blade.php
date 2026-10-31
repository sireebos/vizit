<script>
// Image Upload Handler
document.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll('.image-file-input').forEach(function(input) {
    input.addEventListener('change', function(e) {
      const file = e.target.files[0];
      if (!file) return;

      const targetId = this.dataset.target;
      const hiddenInput = document.getElementById(targetId);
      const nameSpan = document.getElementById(targetId + '_name');
      const previewImg = document.getElementById(targetId + '_preview');
      const placeholder = document.getElementById(targetId + '_placeholder');

      // Show uploading state
      if (nameSpan) nameSpan.textContent = 'Uploading...';

      // Create form data
      const formData = new FormData();
      formData.append('image', file);
      formData.append('_token', '{{ csrf_token() }}');

      fetch('{{ route("admin.upload-image") }}', {
        method: 'POST',
        body: formData
      })
      .then(response => {
        // Check if response is JSON
        const contentType = response.headers.get('content-type');
        if (contentType && contentType.includes('application/json')) {
          return response.json();
        }
        // If not JSON, throw error with status
        throw new Error(`Server error (${response.status}). Please try again or check file size (max 5MB).`);
      })
      .then(data => {
        if (data.success) {
          if (hiddenInput) {
            hiddenInput.value = data.path;
          }
          if (nameSpan) nameSpan.textContent = data.filename;
          if (previewImg) {
            previewImg.src = data.url;
            previewImg.style.display = 'block';
          }
          if (placeholder) placeholder.style.display = 'none';
        } else {
          if (nameSpan) nameSpan.textContent = 'Upload failed';
          alert('Upload failed: ' + (data.message || 'Unknown error'));
        }
      })
      .catch(error => {
        if (nameSpan) nameSpan.textContent = 'Upload failed';
        alert('Upload error: ' + error.message);
      });
    });
  });
});
</script>

