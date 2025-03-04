document.addEventListener('DOMContentLoaded', function() {
  // sidebar toggle
const sidebar = document.getElementById('sidebar');
const mainContent = document.getElementById('main-content');
const toggleSidebarButton = document.getElementById('toggleSidebar');

if (sidebar && mainContent && toggleSidebarButton) {
  toggleSidebarButton.addEventListener('click', () => {
    // Toggles the sidebar off-screen
    sidebar.classList.toggle('-ml-60');
    // Adjusts the main content margin based on sidebar visibility
    mainContent.classList.toggle('ml-60');
  });
}

});


// notification Menus

document.addEventListener('DOMContentLoaded', function() {
    const notificationToggle = document.getElementById('notificationToggle');
    const notificationMenu = document.getElementById('notificationMenu');
  
    if (notificationToggle && notificationMenu) {
        notificationToggle.addEventListener('click', function(event) {
            notificationMenu.classList.toggle('hidden');
            event.stopPropagation();
        });
    }
    // Close dropdowns when clicking outside
    window.addEventListener('click', function(event) {
  
        if (notificationToggle && notificationMenu && !notificationToggle.contains(event.target) && !notificationMenu.contains(event.target)) {
            notificationMenu.classList.add('hidden');
        }
    });
  });
  

  // dropdown menu

  document.addEventListener('DOMContentLoaded', function() {

    const dropdownOptions = document.querySelectorAll('.dropdownOption');
    const dropdownActions = document.querySelectorAll('.dropdownAction');
    
    dropdownOptions.forEach(function(option, index) {
        option.addEventListener('click', function(event) {
            // Hide all other dropdowns first
            dropdownActions.forEach((action, idx) => {
                if (idx !== index) {
                    action.classList.add('hidden');
                }
            });

            // Toggle the current dropdown
            dropdownActions[index].classList.toggle('hidden');
            event.stopPropagation();
        });
    });

    // Close dropdowns when clicking outside
    window.addEventListener('click', function(event) {
        dropdownActions.forEach(function(action) {
            if (!action.contains(event.target)) {
                action.classList.add('hidden');
            }
        });
    });
});

  
  // Login Page Show Password
  
  document.addEventListener('DOMContentLoaded', function () {
    const togglePassword = document.getElementById('togglePassword');
    const password = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');
    
    if (togglePassword && password && eyeIcon) {
        togglePassword.addEventListener('click', function () {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
  
            if (type === 'password') {
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        });
    }
  
      const toggleNav = document.getElementById('toggleNav');
      const navMenu = document.getElementById('navMenu');
      const overlay = document.getElementById('overlay');
      const closeNav = document.getElementById('closeNav');
  
      // Function to open the navigation menu
      function openNav() {
          navMenu.classList.remove('hidden'); // Show the nav menu
          overlay.classList.remove('hidden'); // Show the overlay
      }
  
      // Function to close the navigation menu
      function closeNavMenu() {
          navMenu.classList.add('hidden'); // Hide the nav menu
          overlay.classList.add('hidden'); // Hide the overlay
      }
  
      // Event listeners
      toggleNav.addEventListener('click', openNav);
      closeNav.addEventListener('click', closeNavMenu);
      overlay.addEventListener('click', closeNavMenu);
  });

  
  
// SIDEBAR DROPDOWN BUTTON

document.addEventListener('DOMContentLoaded', function () {
    // Toggle for New Hire Onboarding Submenu
    const toggleNewHireOnboardingSubmenu = document.getElementById('toggleNewHireOnboardingSubmenu');
    const NewHireOnboardingSubmenu = document.getElementById('NewHireOnboardingSubmenu');
    if (toggleNewHireOnboardingSubmenu) {
        toggleNewHireOnboardingSubmenu.addEventListener('click', function () {
            NewHireOnboardingSubmenu.classList.toggle('hidden');
        });
    }

    // Toggle for EmployeeSelfService Submenu
    const toggleEmployeeSelfServiceSubmenu = document.getElementById('toggleEmployeeSelfServiceSubmenu');
    const EmployeeSelfServiceSubmenu = document.getElementById('EmployeeSelfServiceSubmenu');
    if (toggleEmployeeSelfServiceSubmenu) {
        toggleEmployeeSelfServiceSubmenu.addEventListener('click', function () {
            EmployeeSelfServiceSubmenu.classList.toggle('hidden');
        });
    }

    // Toggle for Performance management Submenu
    const togglePerformancemanagementSubmenu = document.getElementById('togglePerformancemanagementSubmenu');
    const PerformancemanagementSubmenu = document.getElementById('PerformancemanagementSubmenu');
    if (togglePerformancemanagementSubmenu) {
        togglePerformancemanagementSubmenu.addEventListener('click', function () {
            PerformancemanagementSubmenu.classList.toggle('hidden');
        });
    }

    // Toggle for Recruitment and Application Submenu
    const toggleRecruitmentandApplicationManagementSubmenu = document.getElementById('toggleRecruitmentandApplicationManagementSubmenu');
    const RecruitmentandApplicationManagementSubmenu = document.getElementById('RecruitmentandApplicationManagementSubmenu');
    if (toggleRecruitmentandApplicationManagementSubmenu) {
        toggleRecruitmentandApplicationManagementSubmenu.addEventListener('click', function () {
            RecruitmentandApplicationManagementSubmenu.classList.toggle('hidden');
         });
    }

     // Toggle for Social Recognition Submenu
     const toggleSocialRecognitionSubmenu = document.getElementById('toggleSocialRecognitionSubmenu');
     const SocialRecognitionSubmenu = document.getElementById('SocialRecognitionSubmenu');
     if (toggleSocialRecognitionSubmenu) {
         toggleSocialRecognitionSubmenu.addEventListener('click', function () {
            SocialRecognitionSubmenu.classList.toggle('hidden');
         });
     }
     

});
