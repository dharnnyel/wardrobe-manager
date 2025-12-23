@extends('layouts.dashboard')
@section('page_title', 'My Interests')
@section('title', 'Interests')

@push('styles')
  <style>
    .interest-card {
      transition: all 0.3s ease;
    }

    .interest-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .item-image {
      transition: all 0.3s ease;
    }

    .item-image:hover {
      transform: scale(1.05);
    }

    /* Image upload styles */
    .image-upload-container {
      border: 2px dashed #d1d5db;
      border-radius: 12px;
      transition: all 0.3s ease;
    }

    .image-upload-container:hover {
      border-color: var(--primary-color);
    }

    .image-upload-container.dragover {
      border-color: #9f7aea;
      background-color: rgba(159, 122, 234, 0.05);
    }

    /* Form styles */
    .form-input {
      width: 100%;
      padding: 0.75rem 1rem;
      border: 1px solid #d1d5db;
      border-radius: 8px;
      transition: all 0.2s ease;
    }

    .form-input:focus {
      outline: none;
      /* border-color: #9f7aea;
                box-shadow: 0 0 0 3px rgba(159, 122, 234, 0.1); */
    }

    .form-label {
      display: block;
      font-weight: 500;
      color: #374151;
      margin-bottom: 0.5rem;
    }

    .form-select {
      width: 100%;
      padding: 0.75rem 1rem;
      border: 1px solid #d1d5db;
      border-radius: 8px;
      background-color: white;
      transition: all 0.2s ease;
    }

    .form-select:focus {
      outline: none;
      border-color: #9f7aea;
      box-shadow: 0 0 0 3px rgba(159, 122, 234, 0.1);
    }

    /* Modal styles */
    .modal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      z-index: 1000;
      align-items: center;
      justify-content: center;
    }

    .modal.show {
      display: flex;
    }

    .modal-content {
      background-color: var(--bg-primary, white);
      border-radius: 16px;
      width: 90%;
      max-width: 600px;
      max-height: 90vh;
      overflow-y: auto;
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
      position: relative;
    }

    .modal-header {
      padding: 20px 24px;
      border-bottom: 1px solid #e5e7eb;
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: sticky;
      top: 0;
      background-color: var(--bg-primary, white);
      z-index: 10;
      border-radius: 16px 16px 0 0;
    }

    .modal-body {
      padding: 24px;
    }

    .modal-close {
      background: none;
      border: none;
      font-size: 1.25rem;
      color: #6b7280;
      cursor: pointer;
      transition: color 0.2s ease;
      position: sticky;
      top: 0;
    }

    .modal-close:hover {
      color: #374151;
    }

    .item-details-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 16px;
    }

    .detail-item {
      margin-bottom: 16px;
    }

    .detail-label {
      font-weight: 500;
      color: #6b7280;
      font-size: 0.875rem;
      margin-bottom: 4px;
    }

    .detail-value {
      font-weight: 400;
      color: var(--text-primary);
      font-size: 1rem;
    }

    .item-image-large {
      width: 100%;
      height: 300px;
      object-fit: cover;
      border-radius: 12px;
      margin-bottom: 20px;
    }

    /* Action buttons */
    .action-btn {
      padding: 8px 12px;
      border-radius: 6px;
      font-size: 14px;
      font-weight: 500;
      transition: all 0.2s ease;
      border: none;
      cursor: pointer;
    }

    .action-btn:hover {
      transform: translateY(-1px);
    }

    .view-btn {
      background-color: rgba(159, 122, 234, 0.1);
      color: #9f7aea;
    }

    .view-btn:hover {
      background-color: rgba(159, 122, 234, 0.2);
    }

    .delete-btn {
      background-color: rgba(252, 129, 129, 0.1);
      color: #fc8181;
    }

    .delete-btn:hover {
      background-color: rgba(252, 129, 129, 0.2);
    }
  </style>
@endpush

@section('content')
  <!-- Interest Content -->
  <div class="container mx-auto px-4 py-8 sm:px-6">
    <!-- Welcome Section -->
    <div class="mb-8">
      <h1 class="responsive-heading text-dark font-bold">
        My Interests
      </h1>
      <p class="responsive-text text-gray-600">
        Track items you're interested in getting
      </p>
    </div>

    <!-- Add Interest Form -->
    <div class="responsive-card mb-8 rounded-2xl bg-white shadow-lg">
      <h2 class="responsive-heading text-dark mb-6 font-bold">
        Add New Interest
      </h2>

      <form class="grid grid-cols-1 gap-6" id="interestForm">
        <div class="space-y-6">
          <!-- Item Name -->
          <div>
            <label class="form-label">Item Name *</label>
            <input class="form-input" id="itemName" placeholder="e.g., Casual Summer Dress" required
              type="text">
          </div>

          <!-- Image Upload -->
          <div>
            <label class="form-label">Item Images</label>
            <div class="image-upload-container cursor-pointer p-6 text-center" id="imageUpload">
              <input accept="image/*" class="hidden" id="itemImage" multiple type="file">
              <i class="fas fa-cloud-upload-alt mb-2 text-3xl text-gray-400"></i>
              <p class="font-medium text-gray-600">Click to upload images</p>
              <p class="text-sm text-gray-500">or drag and drop</p>
              <p class="mt-1 text-xs text-gray-400">PNG, JPG, JPEG up to 5MB each</p>
            </div>
            <div class="mt-4 hidden" id="imagePreview">
              <!-- Images will be appended here -->
            </div>
          </div>
        </div>

        <!-- Additional Fields -->
        <div class="additional-fields grid hidden grid-cols-1 gap-6 lg:grid-cols-2">
          <!-- Left Column -->
          <div class="space-y-6">
            <!-- Size and Size Unit -->
            <div class="grid grid-cols-2 gap-4">
              <div>
                <label class="form-label">Size</label>
                <input class="form-input" id="itemSize" placeholder="e.g., M, 32, 10" type="text">
              </div>
              <div>
                <label class="form-label">Size Unit</label>
                <select class="form-select" id="sizeUnit">
                  <option value="">Select Unit</option>
                  <option value="US">US</option>
                  <option value="EU">EU</option>
                  <option value="UK">UK</option>
                  <option value="cm">cm</option>
                  <option value="inches">inches</option>
                </select>
              </div>
            </div>

            <!-- Color -->
            <div>
              <label class="form-label">Color</label>
              <input class="form-input" id="itemColor" placeholder="e.g., Navy Blue, Red"
                type="text">
            </div>

            <!-- Design -->
            <div>
              <label class="form-label">Design</label>
              <input class="form-input" id="itemDesign" placeholder="e.g., Floral, Striped, Solid"
                type="text">
            </div>
          </div>

          <!-- Right Column -->
          <div class="space-y-6">
            <!-- Material -->
            <div>
              <label class="form-label">Material</label>
              <input class="form-input" id="itemMaterial" placeholder="e.g., Cotton, Silk, Denim"
                type="text">
            </div>

            <!-- Sleeves -->
            <div>
              <label class="form-label">Sleeves</label>
              <select class="form-select" id="itemSleeves">
                <option value="">Select Sleeve Type</option>
                <option value="sleeveless">Sleeveless</option>
                <option value="short">Short Sleeves</option>
                <option value="three-quarter">Three-Quarter</option>
                <option value="long">Long Sleeves</option>
              </select>
            </div>

            <!-- Collar -->
            <div>
              <label class="form-label">Collar</label>
              <select class="form-select" id="itemCollar">
                <option value="">Select Collar Type</option>
                <option value="round">Round Neck</option>
                <option value="v-neck">V-Neck</option>
                <option value="polo">Polo Collar</option>
                <option value="button-down">Button-Down</option>
                <option value="turtleneck">Turtleneck</option>
                <option value="hood">Hood</option>
              </select>
            </div>
          </div>
        </div>

        <!-- Submit Button -->
        <div>
          <button
            class="bg-primary responsive-button mx-auto flex w-full max-w-2xl items-center justify-center rounded-lg font-bold text-white transition hover:bg-purple-700"
            type="submit">
            <i class="fas fa-plus mr-2"></i>Add to Interests
          </button>
        </div>
      </form>
    </div>

    <!-- My Interests Grid -->
    <div class="responsive-card rounded-2xl bg-white shadow-lg">
      <h2 class="responsive-heading text-dark mb-6 font-bold">
        My Interest Items
      </h2>

      <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3" id="interestsGrid">
        <!-- Static Interest Item 1 -->
        <div class="interest-card overflow-hidden rounded-xl border border-gray-200 bg-white">
          <div class="h-48 overflow-hidden bg-gray-100">
            <img alt="Casual Summer Dress" class="item-image h-full w-full object-cover"
              src="https://images.unsplash.com/photo-1595777457583-95e059d581b8?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80">
          </div>
          <div class="p-4">
            <h3 class="text-dark mb-2 font-bold">Casual Summer Dress</h3>
            <div class="space-y-1 text-sm text-gray-600">
              <p><span class="font-medium">Size:</span> M US</p>
              <p><span class="font-medium">Color:</span> Navy Blue</p>
              <p><span class="font-medium">Design:</span> Floral Print</p>
            </div>
            <div class="mt-4 flex items-center justify-between">
              <span class="text-xs text-gray-500">Added 2 days ago</span>
              <div class="flex space-x-2">
                <button class="action-btn view-btn view-interest" data-id="1">
                  <i class="fas fa-eye mr-1"></i>View
                </button>
                <button class="action-btn delete-btn delete-interest">
                  <i class="fas fa-trash"></i>
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- Static Interest Item 2 -->
        <div class="interest-card overflow-hidden rounded-xl border border-gray-200 bg-white">
          <div class="h-48 overflow-hidden bg-gray-100">
            <img alt="Denim Jacket" class="item-image h-full w-full object-cover"
              src="https://images.unsplash.com/photo-1583496661160-fb5886a13d77?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80">
          </div>
          <div class="p-4">
            <h3 class="text-dark mb-2 font-bold">Classic Denim Jacket</h3>
            <div class="space-y-1 text-sm text-gray-600">
              <p><span class="font-medium">Size:</span> L US</p>
              <p><span class="font-medium">Color:</span> Light Blue</p>
              <p><span class="font-medium">Design:</span> Solid</p>
            </div>
            <div class="mt-4 flex items-center justify-between">
              <span class="text-xs text-gray-500">Added 1 week ago</span>
              <div class="flex space-x-2">
                <button class="action-btn view-btn view-interest" data-id="2">
                  <i class="fas fa-eye mr-1"></i>View
                </button>
                <button class="action-btn delete-btn delete-interest">
                  <i class="fas fa-trash"></i>
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- Static Interest Item 3 -->
        <div class="interest-card overflow-hidden rounded-xl border border-gray-200 bg-white">
          <div class="h-48 overflow-hidden bg-gray-100">
            <div class="flex h-full w-full items-center justify-center text-gray-400">
              <i class="fas fa-image text-4xl"></i>
            </div>
          </div>
          <div class="p-4">
            <h3 class="text-dark mb-2 font-bold">Running Shoes</h3>
            <div class="space-y-1 text-sm text-gray-600">
              <p><span class="font-medium">Size:</span> 10 US</p>
              <p><span class="font-medium">Color:</span> Black/Red</p>
              <p><span class="font-medium">Design:</span> Athletic</p>
            </div>
            <div class="mt-4 flex items-center justify-between">
              <span class="text-xs text-gray-500">Added today</span>
              <div class="flex space-x-2">
                <button class="action-btn view-btn view-interest" data-id="3">
                  <i class="fas fa-eye mr-1"></i>View
                </button>
                <button class="action-btn delete-btn delete-interest">
                  <i class="fas fa-trash"></i>
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- This will be hidden when there are items -->
        <div class="col-span-3 hidden py-8 text-center text-gray-500" id="noInterestsMessage">
          <i class="fas fa-heart mb-3 text-3xl text-gray-300"></i>
          <p>No interest items yet. Add your first item above!</p>
        </div>
      </div>
    </div>
  </div>

  <!-- View Interest Modal -->
  <div class="modal" id="viewInterestModal">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="text-dark text-xl font-medium" id="modalTitle">Casual Summer Dress</h2>
        <button class="modal-close" id="closeModal">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <div class="modal-body">
        <img alt="Casual Summer Dress" class="item-image-large"
          src="https://images.unsplash.com/photo-1595777457583-95e059d581b8?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80">
        <div class="item-details-grid">
          <div class="detail-item">
            <div class="detail-label">Brand</div>
            <div class="detail-value">Zara</div>
          </div>
          <div class="detail-item">
            <div class="detail-label">Color</div>
            <div class="detail-value">Navy Blue</div>
          </div>
          <div class="detail-item">
            <div class="detail-label">Size</div>
            <div class="detail-value">M US</div>
          </div>
          <div class="detail-item">
            <div class="detail-label">Length</div>
            <div class="detail-value">Knee Length</div>
          </div>
          <div class="detail-item">
            <div class="detail-label">Material</div>
            <div class="detail-value">Cotton Blend</div>
          </div>
          <div class="detail-item">
            <div class="detail-label">Care Instructions</div>
            <div class="detail-value">Machine wash cold, tumble dry low</div>
          </div>
          <div class="detail-item">
            <div class="detail-label">Design</div>
            <div class="detail-value">Floral Print</div>
          </div>
          <div class="detail-item">
            <div class="detail-label">Sleeves</div>
            <div class="detail-value">Short Sleeves</div>
          </div>
          <div class="detail-item">
            <div class="detail-label">Collar</div>
            <div class="detail-value">Round Neck</div>
          </div>
          <div class="detail-item">
            <div class="detail-label">Estimated Price</div>
            <div class="detail-value">$49.99</div>
          </div>
        </div>
        <div class="detail-item mt-4">
          <div class="detail-label">Additional Notes</div>
          <div class="detail-value">Perfect for summer outings and casual events. Looking for this in
            navy blue with floral pattern.</div>
        </div>
        <div class="mt-6 flex justify-end space-x-3">
          <button class="action-btn delete-btn">
            <i class="fas fa-trash mr-1"></i>Remove Interest
          </button>
          <button class="action-btn view-btn">
            <i class="fas fa-shopping-cart mr-1"></i>Find Online
          </button>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    // Sample data for interests
    let interests = JSON.parse(localStorage.getItem('interests')) || [];

    // DOM Elements
    const interestForm = document.getElementById('interestForm');
    const imageUpload = document.getElementById('imageUpload');
    const itemImageInput = document.getElementById('itemImage');
    const imagePreview = document.getElementById('imagePreview');
    const additionalFields = document.querySelector('.additional-fields');
    const interestsGrid = document.getElementById('interestsGrid');
    const noInterestsMessage = document.getElementById('noInterestsMessage');

    // Modal elements
    const viewInterestModal = document.getElementById('viewInterestModal');
    const closeModalBtn = document.getElementById('closeModal');

    // Initialize the page
    document.addEventListener('DOMContentLoaded', function() {
      // Since we have static items, ensure the no interests message is hidden
      noInterestsMessage.classList.add('hidden');

      // Add event listeners for view buttons
      document.querySelectorAll('.view-interest').forEach(button => {
        button.addEventListener('click', openInterestModal);
      });

      // Add event listener for removing images
      imagePreview.addEventListener('click', function(e) {
        if (e.target.closest('.remove-image')) {
          const index = parseInt(e.target.closest('.remove-image').getAttribute(
            'data-index'));
          removeImageAtIndex(index);
        }
      });
    });

    // Open modal
    function openInterestModal() {
      viewInterestModal.classList.add('show');
      document.body.style.overflow = 'hidden';
    }

    // Close modal
    function closeModal() {
      viewInterestModal.classList.remove('show');
      document.body.style.overflow = '';
    }

    // Handle form submission
    async function handleFormSubmit(e) {
      e.preventDefault();

      const imagePromises = Array.from(itemImageInput.files).map(file => {
        return new Promise(resolve => {
          const reader = new FileReader();
          reader.onload = () => resolve(reader.result);
          reader.readAsDataURL(file);
        });
      });

      const images = await Promise.all(imagePromises);

      const formData = {
        id: Date.now(),
        name: document.getElementById('itemName').value,
        size: document.getElementById('itemSize').value,
        sizeUnit: document.getElementById('sizeUnit').value,
        color: document.getElementById('itemColor').value,
        design: document.getElementById('itemDesign').value,
        material: document.getElementById('itemMaterial').value,
        sleeves: document.getElementById('itemSleeves').value,
        collar: document.getElementById('itemCollar').value,
        images: images,
        createdAt: new Date().toISOString()
      };

      // Add to interests array
      interests.unshift(formData);

      // Save to localStorage
      localStorage.setItem('interests', JSON.stringify(interests));

      // Reset form
      interestForm.reset();
      removeUploadedImages();

      // Update UI
      renderInterests();

      // Show success message
      alert('Interest item added successfully!');
    }

    // Handle image upload
    function handleImageUpload() {
      const files = itemImageInput.files;
      if (files.length > 0) {
        imagePreview.innerHTML = '';
        Array.from(files).forEach((file, index) => {
          const reader = new FileReader();
          reader.onload = function(e) {
            const imgContainer = document.createElement('div');
            imgContainer.className = 'relative inline-block mr-2 mb-2';
            imgContainer.innerHTML = `
              <img src="${e.target.result}" class="h-24 w-24 object-cover rounded-lg">
              <button type="button" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs remove-image" data-index="${index}">
                <i class="fas fa-times"></i>
              </button>
            `;
            imagePreview.appendChild(imgContainer);
          };
          reader.readAsDataURL(file);
        });
        imagePreview.classList.remove('hidden');
        additionalFields.classList.remove('hidden');
      } else {
        imagePreview.classList.add('hidden');
        additionalFields.classList.add('hidden');
      }
    }

    // Remove image at specific index
    function removeImageAtIndex(index) {
      const dt = new DataTransfer();
      const files = Array.from(itemImageInput.files);
      files.splice(index, 1); // Remove the file at index
      files.forEach(file => dt.items.add(file));
      itemImageInput.files = dt.files;
      handleImageUpload(); // Re-render previews
    }

    // Remove all uploaded images
    function removeUploadedImages() {
      itemImageInput.value = '';
      imagePreview.innerHTML = '';
      imagePreview.classList.add('hidden');
      additionalFields.classList.add('hidden');
    }

    // Render interests grid
    function renderInterests() {
      if (interests.length === 0) {
        noInterestsMessage.classList.remove('hidden');
        return;
      }

      noInterestsMessage.classList.add('hidden');

      interestsGrid.innerHTML = interests.map(interest => `
                <div class="interest-card bg-white border border-gray-200 rounded-xl overflow-hidden">
                    <div class="h-48 bg-gray-100 overflow-hidden">
                        ${interest.images && interest.images.length > 0 ?
                            `<img src="${interest.images[0]}" alt="${interest.name}" class="w-full h-full object-cover item-image">` :
                            `<div class="w-full h-full flex items-center justify-center text-gray-400">
                                              <i class="fas fa-image text-4xl"></i>
                                          </div>`
                        }
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-dark mb-2">${interest.name}</h3>
                        <div class="space-y-1 text-sm text-gray-600">
                            ${interest.size ? `<p><span class="font-medium">Size:</span> ${interest.size} ${interest.sizeUnit}</p>` : ''}
                            ${interest.color ? `<p><span class="font-medium">Color:</span> ${interest.color}</p>` : ''}
                            ${interest.design ? `<p><span class="font-medium">Design:</span> ${interest.design}</p>` : ''}
                        </div>
                        <div class="flex justify-between items-center mt-4">
                            <span class="text-xs text-gray-500">${new Date(interest.createdAt).toLocaleDateString()}</span>
                            <div class="flex space-x-2">
                              <button class="action-btn view-btn view-interest" data-id="${interest.id}">
                                <i class="fas fa-eye mr-1"></i>View
                              </button>
                              <button class="action-btn delete-btn delete-interest" data-id="${interest.id}">
                                <i class="fas fa-trash"></i>
                              </button>
                            </div>
                        </div>
                    </div>
                </div>
            `).join('');

      // Add event listeners for dynamically created items
      document.querySelectorAll('.view-interest').forEach(button => {
        button.addEventListener('click', openInterestModal);
      });

      document.querySelectorAll('.delete-interest').forEach(button => {
        button.addEventListener('click', function() {
          const id = parseInt(this.getAttribute('data-id'));
          deleteInterest(id);
        });
      });
    }

    // Delete interest item
    function deleteInterest(id) {
      if (confirm('Are you sure you want to delete this interest item?')) {
        interests = interests.filter(interest => interest.id !== id);
        localStorage.setItem('interests', JSON.stringify(interests));
        renderInterests();
      }
    }

    // Event Listeners
    interestForm.addEventListener('submit', handleFormSubmit);
    imageUpload.addEventListener('click', () => itemImageInput.click());
    itemImageInput.addEventListener('change', handleImageUpload);
    closeModalBtn.addEventListener('click', closeModal);

    // Close modal when clicking outside
    viewInterestModal.addEventListener('click', function(event) {
      if (event.target === viewInterestModal) {
        closeModal();
      }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(event) {
      if (event.key === 'Escape' && viewInterestModal.classList.contains('show')) {
        closeModal();
      }
    });

    // Add delete functionality to static items
    document.querySelectorAll('.delete-interest').forEach(button => {
      if (!button.hasAttribute('data-id')) {
        button.addEventListener('click', function() {
          // For static items, just remove from DOM
          if (confirm('Are you sure you want to remove this interest item?')) {
            this.closest('.interest-card').remove();
          }
        });
      }
    });
  </script>
@endpush
