document.addEventListener("DOMContentLoaded", () => {
    // --------------------------------------------------------
    // 1. Interactive Effects (Hover/Focus across all pages)
    // --------------------------------------------------------
    
    // Add smooth focus effect to all input fields
    const inputs = document.querySelectorAll('input');
    inputs.forEach(input => {
        input.addEventListener('focus', () => {
            input.style.boxShadow = '0 0 8px rgba(255, 0, 0, 0.4)';
            input.style.borderColor = 'red';
            input.style.transition = 'all 0.3s ease';
            input.style.outline = 'none';
        });
        input.addEventListener('blur', () => {
            input.style.boxShadow = 'none';
            input.style.borderColor = '';
        });
    });

    // --------------------------------------------------------
    // 2. index.html - DOM Manipulation & Events
    // --------------------------------------------------------
    
    // Search Box Implementation
    const searchInput = document.querySelector('.search-box input');
    if (searchInput) {
        searchInput.addEventListener('keyup', (e) => {
            if (e.key === 'Enter') {
                if (searchInput.value.trim() !== "") {
                    alert(`Searching for: ${searchInput.value}`);
                    searchInput.value = ''; // clear input after search
                }
            }
        });
    }

    // Add To Cart Functionality & Notifications
    const addToCartBtns = document.querySelectorAll('.product button');
    if (addToCartBtns.length > 0) {
        // Create a dynamic notification container element (DOM Manipulation)
        const notification = document.createElement('div');
        notification.style.position = 'fixed';
        notification.style.bottom = '20px';
        notification.style.right = '20px';
        notification.style.padding = '15px 25px';
        notification.style.backgroundColor = '#4CAF50'; // Green color
        notification.style.color = 'white';
        notification.style.borderRadius = '5px';
        notification.style.boxShadow = '0 4px 8px rgba(0,0,0,0.2)';
        notification.style.display = 'none';
        notification.style.zIndex = '1000';
        notification.style.transition = 'opacity 0.4s ease';
        notification.style.fontSize = '16px';
        document.body.appendChild(notification);

        addToCartBtns.forEach(btn => {
            // Add hover effect programmatically
            btn.style.transition = 'transform 0.2s, background-color 0.2s';
            btn.addEventListener('mouseenter', () => { btn.style.backgroundColor = 'red'; btn.style.color = 'white'; });
            btn.addEventListener('mouseleave', () => { btn.style.backgroundColor = ''; btn.style.color = 'black'; });

            // Click event listener
            btn.addEventListener('click', (e) => {
                const productCard = e.target.closest('.product');
                // DOM Traversal
                const productName = productCard.querySelector('h4').innerText;
                
                // Show notification
                notification.innerText = `🛒 ${productName} added to cart!`;
                notification.style.display = 'block';
                // Small delay to allow CSS transition to process
                setTimeout(() => { notification.style.opacity = '1'; }, 10);
                
                // Click Effect (scaling button down then up)
                btn.style.transform = 'scale(0.9)';
                setTimeout(() => {
                    btn.style.transform = 'scale(1)';
                }, 150);

                // Auto-hide notification after 3 seconds
                setTimeout(() => {
                    notification.style.opacity = '0';
                    setTimeout(() => { notification.style.display = 'none'; }, 400); // Wait for fade out
                }, 3000);
            });
        });
    }

    // --------------------------------------------------------
    // 3. login.html & register.html - Form Validations
    // --------------------------------------------------------
    
    // Login Form Validation
    const loginForm = document.querySelector('.login-box form[action="login.php"]');
    if (loginForm) {
        loginForm.addEventListener('submit', (e) => {
            const email = loginForm.querySelector('input[name="email"]').value;
            const password = loginForm.querySelector('input[name="password"]').value;
            
            if(!email || !password) {
                e.preventDefault(); // Stop form submission action
                alert("Please fill in both Email and Password fields.");
            }
        });
    }

    // Register Form Validation (Password Match check)
    const registerForm = document.querySelector('.login-box form[action="register.php"]');
    if (registerForm) {
        registerForm.addEventListener('submit', (e) => {
            const password = registerForm.querySelector('input[name="password"]').value;
            const cpassword = registerForm.querySelector('input[name="cpassword"]').value;
            
            if (password !== cpassword) {
                e.preventDefault(); // Stop form submission
                alert("❌ Passwords do not match! Please try again.");
                
                // Highlight inputs with mismatch
                const cpasswordInput = registerForm.querySelector('input[name="cpassword"]');
                cpasswordInput.style.borderColor = 'red';
                cpasswordInput.focus();
            } else if (password.length < 6) {
                e.preventDefault();
                alert("⚠️ Password must be at least 6 characters long.");
            }
        });
    }
});
