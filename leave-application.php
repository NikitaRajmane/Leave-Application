<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Staff Leave Application with Principal &amp; HOD Permission</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  <style>
    /* Reset and base */
    *, *::before, *::after { box-sizing: border-box; }
    body {
      margin: 0; padding: 0; font-family: 'Inter', sans-serif, Arial, sans-serif;
      background: linear-gradient(135deg, #e0eaff, #c8dbff);
      color: #222;
      min-height: 100vh;
      display: flex; flex-direction: column;
    }
    /* Scrollbar */
    ::-webkit-scrollbar {
      width: 10px;
      background: transparent;
    }
    ::-webkit-scrollbar-thumb {
      background-color: rgba(99,102,241,0.6);
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }
    ::-webkit-scrollbar-thumb:hover {
      background-color: rgba(99,102,241,0.9);
    }

    /* Layout */
    header {
      position: sticky; top: 0; height: 64px;
      backdrop-filter: blur(20px);
      background: rgba(255, 255, 255, 0.4);
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      display: flex; align-items: center; padding: 0 24px;
      z-index: 100;
      user-select: none;
    }
    header h1 {
      font-weight: 700; font-size: clamp(1.25rem, 2vw, 1.75rem);
      color: #3b3e76;
      display: flex; align-items: center; gap: 8px;
    }
    header h1 .material-icons {
      color: #6366f1;
      font-size: 32px;
    }

    main {
      flex: 1 1 auto;
      display: flex;
      padding: 16px;
      max-width: 1200px;
      margin: auto;
      width: 100%;
      min-height: calc(100vh - 64px);
    }

    /* Sidebar */
    nav.sidebar {
      width: 280px;
      background: rgba(255,255,255,0.6);
      border-radius: 16px;
      box-shadow: 0 8px 24px rgba(99,102,241,0.15);
      backdrop-filter: blur(20px);
      padding: 24px 16px;
      margin-right: 24px;
      display: flex; flex-direction: column; gap: 16px;
    }
    nav.sidebar h2 {
      font-size: 1.25rem; font-weight: 700; color: #4f46e5;
      margin-bottom: 12px;
      user-select: none;
      display: flex; align-items: center; gap: 8px;
    }
    nav.sidebar h2 .material-icons {
      font-size: 28px;
    }
    nav.sidebar a {
      color: #3b3e76;
      text-decoration: none;
      font-weight: 600;
      font-size: 1rem;
      padding: 8px 12px;
      border-radius: 12px;
      display: flex; align-items: center; gap: 12px;
      transition: background-color 0.25s ease;
      user-select: none;
    }
    nav.sidebar a:hover, nav.sidebar a:focus-visible {
      background: #6366f1;
      color: white;
      outline: none;
      box-shadow: 0 0 12px rgba(99,102,241,0.8);
    }
    nav.sidebar a .material-icons {
      font-size: 20px;
      flex-shrink: 0;
    }
    nav.sidebar a .badge {
      background: #ef4444;
      color: white;
      font-size: 0.75rem;
      font-weight: 700;
      padding: 2px 6px;
      border-radius: 12px;
      margin-left: auto;
    }

    /* Content area */
    section.content {
      flex: 1 1 auto;
      background: rgba(255,255,255,0.85);
      border-radius: 20px;
      padding: 32px;
      box-shadow: 0 12px 40px rgba(99,102,241,0.25);
      backdrop-filter: blur(28px);
      max-width: 100%;
      overflow-y: auto;
      min-height: 600px;
    }

    /* Form styling */
    form {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 24px;
    }
    form .full-width {
      grid-column: 1 / -1;
    }
    label {
      font-weight: 600;
      color: #4b4f6c;
      display: block;
      margin-bottom: 6px;
      user-select: none;
    }
    input[type="text"],
    input[type="date"],
    select,
    textarea {
      width: 100%;
      padding: 12px 16px;
      border-radius: 12px;
      border: 1.5px solid #d1d5db;
      font-size: clamp(0.9rem, 1vw, 1.1rem);
      font-family: inherit;
      transition: border-color 0.3s ease, box-shadow 0.3s ease;
      resize: vertical;
      min-height: 44px;
    }
    textarea {
      min-height: 100px;
    }
    input[type="text"]:focus,
    input[type="date"]:focus,
    select:focus,
    textarea:focus {
      border-color: #6366f1;
      outline: none;
      box-shadow: 0 0 8px rgba(99,102,241,0.5);
    }

    /* Validation error */
    .error-message {
      color: #dc2626;
      font-size: 0.85rem;
      margin-top: 4px;
      user-select: none;
    }

    /* Buttons */
    button[type="submit"] {
      grid-column: 1 / -1;
      background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
      border: none;
      color: white;
      font-size: clamp(1rem, 1.2vw, 1.3rem);
      font-weight: 700;
      padding: 14px 0;
      border-radius: 16px;
      cursor: pointer;
      transition: transform 0.25s ease, box-shadow 0.3s ease;
      user-select: none;
      box-shadow: 0 8px 20px rgba(99,102,241,0.5);
    }
    button[type="submit"]:hover,
    button[type="submit"]:focus-visible {
      transform: translateY(-3px);
      box-shadow: 0 12px 40px rgba(99,102,241,0.7);
      outline: none;
    }

    /* Success and info messages */
    .message {
      grid-column: 1 / -1;
      padding: 12px 16px;
      border-radius: 12px;
      font-weight: 600;
      color: #166534;
      background-color: #dcfce7;
      border: 1.5px solid #4ade80;
      display: flex;
      align-items: center;
      gap: 12px;
    }
    .message.error {
      background-color: #fee2e2;
      color: #b91c1c;
      border-color: #f87171;
    }

    /* Responsive */
    @media (max-width: 767px) {
      main {
        flex-direction: column;
        padding: 12px;
      }
      nav.sidebar {
        width: 100%;
        margin-right: 0;
        margin-bottom: 16px;
        flex-direction: row;
        overflow-x: auto;
        padding: 12px 8px;
        border-radius: 12px;
        gap: 12px;
        box-shadow: 0 8px 20px rgba(99,102,241,0.1);
      }
      nav.sidebar a {
        flex-shrink: 0;
        padding: 8px 12px;
        font-size: 0.9rem;
      }
      section.content {
        padding: 24px 16px;
        min-height: auto;
      }
      form {
        grid-template-columns: 1fr;
        gap: 16px;
      }
      button[type="submit"] {
        font-size: 1.1rem;
      }
    }
  </style>
</head>
<body>
<?php
// Define helper function for sanitizing inputs
function sanitize_input($data) {
  return htmlspecialchars(trim($data));
}

// Initialize variables and errors
$errors = [];
$successMessage = '';
$input = [
  'staff_name' => '',
  'staff_id' => '',
  'leave_start' => '',
  'leave_end' => '',
  'leave_reason' => '',
  'principal_permission' => 'Pending',
  'hod_permission' => 'Pending'
];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect input with sanitization
    $input['staff_name'] = sanitize_input($_POST['staff_name'] ?? '');
    $input['staff_id'] = sanitize_input($_POST['staff_id'] ?? '');
    $input['leave_start'] = sanitize_input($_POST['leave_start'] ?? '');
    $input['leave_end'] = sanitize_input($_POST['leave_end'] ?? '');
    $input['leave_reason'] = sanitize_input($_POST['leave_reason'] ?? '');
    $input['principal_permission'] = sanitize_input($_POST['principal_permission'] ?? 'Pending');
    $input['hod_permission'] = sanitize_input($_POST['hod_permission'] ?? 'Pending');

    // Validate inputs
    if (strlen($input['staff_name']) < 3) {
      $errors['staff_name'] = 'Please enter a valid name (at least 3 characters).';
    }
    if (!preg_match('/^[a-zA-Z0-9]+$/', $input['staff_id'])) {
      $errors['staff_id'] = 'Staff ID should be alphanumeric without spaces.';
    }
    if (!$input['leave_start']) {
      $errors['leave_start'] = 'Please select leave start date.';
    }
    if (!$input['leave_end']) {
      $errors['leave_end'] = 'Please select leave end date.';
    }
    if ($input['leave_start'] && $input['leave_end'] && $input['leave_end'] < $input['leave_start']) {
      $errors['leave_end'] = 'Leave end date cannot be before start date.';
    }
    if (strlen($input['leave_reason']) < 10) {
      $errors['leave_reason'] = 'Please provide a detailed leave reason (min 10 characters).';
    }
    $validPermissions = ['Pending', 'Approved', 'Denied'];
    if (!in_array($input['principal_permission'], $validPermissions)) {
      $errors['principal_permission'] = 'Invalid selection for Principal Permission.';
    }
    if (!in_array($input['hod_permission'], $validPermissions)) {
      $errors['hod_permission'] = 'Invalid selection for HOD Permission.';
    }

    // If no errors, process and save data
    if (empty($errors)) {
      $leaveRequest = [
        'id' => uniqid('leave_', true),
        'staff_name' => $input['staff_name'],
        'staff_id' => $input['staff_id'],
        'leave_start' => $input['leave_start'],
        'leave_end' => $input['leave_end'],
        'leave_reason' => $input['leave_reason'],
        'principal_permission' => $input['principal_permission'],
        'hod_permission' => $input['hod_permission'],
        'submitted_at' => date('c')
      ];

      // Save to JSON file
      $dataFile = __DIR__ . '/leave_requests.json';
      if (file_exists($dataFile)) {
        $rawData = file_get_contents($dataFile);
        $requests = json_decode($rawData, true);
        if (!is_array($requests)) { $requests = []; }
      } else {
        $requests = [];
      }

      $requests[] = $leaveRequest;
      
      $saveSuccess = file_put_contents($dataFile, json_encode($requests, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
      if ($saveSuccess !== false) {
        $successMessage = 'Leave application submitted successfully.';
        // Clear form after success
        $input = [
          'staff_name' => '',
          'staff_id' => '',
          'leave_start' => '',
          'leave_end' => '',
          'leave_reason' => '',
          'principal_permission' => 'Pending',
          'hod_permission' => 'Pending'
        ];
      } else {
        $errors['form'] = 'Unable to save leave application at this time. Please try again later.';
      }
    }
}
?>
  <header role="banner">
    <h1><span class="material-icons" aria-hidden="true">event_note</span> Leave Application</h1>
  </header>
  <main>
    <nav class="sidebar" aria-label="Primary navigation">
      <h2><span class="material-icons" aria-hidden="true">menu</span> Navigation</h2>
      <a href="#" tabindex="0"><span class="material-icons">home</span> Dashboard</a>
      <a href="#" tabindex="0"><span class="material-icons">assignment</span> Leave Applications <span class="badge" aria-label="New leave applications">3</span></a>
      <a href="#" tabindex="0"><span class="material-icons">person</span> Profile</a>
      <a href="#" tabindex="0"><span class="material-icons">settings</span> Settings</a>
      <a href="#" tabindex="0"><span class="material-icons">logout</span> Logout</a>
    </nav>
    <section class="content" role="main" aria-labelledby="formTitle">
      <h2 id="formTitle" style="margin-top:0; margin-bottom:24px; color:#4f46e5;">Staff Leave Application Form</h2>
      <?php if ($successMessage): ?>
        <div class="message" role="alert" aria-live="polite">
          <span class="material-icons" aria-hidden="true" style="color:#22c55e;">check_circle</span> <?= $successMessage ?>
        </div>
      <?php endif; ?>
      
      <?php if (!empty($errors['form'])): ?>
        <div class="message error" role="alert" aria-live="assertive">
          <span class="material-icons" aria-hidden="true" style="color:#dc2626;">error</span> <?= $errors['form'] ?>
        </div>
      <?php endif; ?>

      <form method="post" action="#formTitle" novalidate aria-describedby="formDesc">
        <p id="formDesc" style="font-size:0.9rem; color:#6b7280; margin-bottom:24px; max-width: 600px;">
          Please fill out the leave application form below. Fields marked with * are mandatory.
        </p>

        <div>
          <label for="staff_name">Staff Name *</label>
          <input type="text" id="staff_name" name="staff_name" required maxlength="100" aria-required="true" aria-describedby="error_staff_name"
            value="<?= htmlspecialchars($input['staff_name']) ?>" autocomplete="name" />
          <?php if (!empty($errors['staff_name'])): ?>
            <div class="error-message" role="alert" id="error_staff_name"><?= $errors['staff_name'] ?></div>
          <?php endif; ?>
        </div>

        <div>
          <label for="staff_id">Staff ID *</label>
          <input type="text" id="staff_id" name="staff_id" required maxlength="20" aria-required="true" aria-describedby="error_staff_id"
            value="<?= htmlspecialchars($input['staff_id']) ?>" autocomplete="off" />
          <?php if (!empty($errors['staff_id'])): ?>
            <div class="error-message" role="alert" id="error_staff_id"><?= $errors['staff_id'] ?></div>
          <?php endif; ?>
        </div>

        <div>
          <label for="leave_start">Leave Start Date *</label>
          <input type="date" id="leave_start" name="leave_start" required aria-required="true" aria-describedby="error_leave_start"
            value="<?= htmlspecialchars($input['leave_start']) ?>" />
          <?php if (!empty($errors['leave_start'])): ?>
            <div class="error-message" role="alert" id="error_leave_start"><?= $errors['leave_start'] ?></div>
          <?php endif; ?>
        </div>

        <div>
          <label for="leave_end">Leave End Date *</label>
          <input type="date" id="leave_end" name="leave_end" required aria-required="true" aria-describedby="error_leave_end"
            value="<?= htmlspecialchars($input['leave_end']) ?>" />
          <?php if (!empty($errors['leave_end'])): ?>
            <div class="error-message" role="alert" id="error_leave_end"><?= $errors['leave_end'] ?></div>
          <?php endif; ?>
        </div>

        <div class="full-width">
          <label for="leave_reason">Reason for Leave *</label>
          <textarea id="leave_reason" name="leave_reason" required aria-required="true" aria-describedby="error_leave_reason" placeholder="Explain your reason for leave"><?= htmlspecialchars($input['leave_reason']) ?></textarea>
          <?php if (!empty($errors['leave_reason'])): ?>
            <div class="error-message" role="alert" id="error_leave_reason"><?= $errors['leave_reason'] ?></div>
          <?php endif; ?>
        </div>

        <div>
          <label for="principal_permission">Principal Permission</label>
          <select id="principal_permission" name="principal_permission" aria-describedby="error_principal_permission" autocomplete="off">
            <option value="Pending" <?= $input['principal_permission'] === 'Pending' ? 'selected' : '' ?>>Pending</option>
            <option value="Approved" <?= $input['principal_permission'] === 'Approved' ? 'selected' : '' ?>>Approved</option>
            <option value="Denied" <?= $input['principal_permission'] === 'Denied' ? 'selected' : '' ?>>Denied</option>
          </select>
          <?php if (!empty($errors['principal_permission'])): ?>
            <div class="error-message" role="alert" id="error_principal_permission"><?= $errors['principal_permission'] ?></div>
          <?php endif; ?>
        </div>

        <div>
          <label for="hod_permission">HOD Permission</label>
          <select id="hod_permission" name="hod_permission" aria-describedby="error_hod_permission" autocomplete="off">
            <option value="Pending" <?= $input['hod_permission'] === 'Pending' ? 'selected' : '' ?>>Pending</option>
            <option value="Approved" <?= $input['hod_permission'] === 'Approved' ? 'selected' : '' ?>>Approved</option>
            <option value="Denied" <?= $input['hod_permission'] === 'Denied' ? 'selected' : '' ?>>Denied</option>
          </select>
          <?php if (!empty($errors['hod_permission'])): ?>
            <div class="error-message" role="alert" id="error_hod_permission"><?= $errors['hod_permission'] ?></div>
          <?php endif; ?>
        </div>

        <button type="submit" aria-label="Submit Leave Application Form">
          <span class="material-icons" aria-hidden="true" style="vertical-align: middle;">send</span> Submit Application
        </button>
      </form>
    </section>
  </main>
</body>
</html>

