<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg13.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql13.php") ?>
<?php include_once "phpfn13.php" ?>
<?php include_once "t03_pinjamaninfo.php" ?>
<?php include_once "t96_employeesinfo.php" ?>
<?php include_once "userfn13.php" ?>
<?php

//
// Page class
//

$t03_pinjaman_delete = NULL; // Initialize page object first

class ct03_pinjaman_delete extends ct03_pinjaman {

	// Page ID
	var $PageID = 'delete';

	// Project ID
	var $ProjectID = "{4A92113F-FAF7-42E0-B722-EA94135527E4}";

	// Table name
	var $TableName = 't03_pinjaman';

	// Page object name
	var $PageObjName = 't03_pinjaman_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		if ($this->UseTokenInUrl) $PageUrl .= "t=" . $this->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_MESSAGE], $v);
	}

	function getFailureMessage() {
		return @$_SESSION[EW_SESSION_FAILURE_MESSAGE];
	}

	function setFailureMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_FAILURE_MESSAGE], $v);
	}

	function getSuccessMessage() {
		return @$_SESSION[EW_SESSION_SUCCESS_MESSAGE];
	}

	function setSuccessMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_SUCCESS_MESSAGE], $v);
	}

	function getWarningMessage() {
		return @$_SESSION[EW_SESSION_WARNING_MESSAGE];
	}

	function setWarningMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_WARNING_MESSAGE], $v);
	}

	// Methods to clear message
	function ClearMessage() {
		$_SESSION[EW_SESSION_MESSAGE] = "";
	}

	function ClearFailureMessage() {
		$_SESSION[EW_SESSION_FAILURE_MESSAGE] = "";
	}

	function ClearSuccessMessage() {
		$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = "";
	}

	function ClearWarningMessage() {
		$_SESSION[EW_SESSION_WARNING_MESSAGE] = "";
	}

	function ClearMessages() {
		$_SESSION[EW_SESSION_MESSAGE] = "";
		$_SESSION[EW_SESSION_FAILURE_MESSAGE] = "";
		$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = "";
		$_SESSION[EW_SESSION_WARNING_MESSAGE] = "";
	}

	// Show message
	function ShowMessage() {
		$hidden = FALSE;
		$html = "";

		// Message
		$sMessage = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sMessage, "");
		if ($sMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sMessage;
			$html .= "<div class=\"alert alert-info ewInfo\">" . $sMessage . "</div>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$sWarningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sWarningMessage, "warning");
		if ($sWarningMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sWarningMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sWarningMessage;
			$html .= "<div class=\"alert alert-warning ewWarning\">" . $sWarningMessage . "</div>";
			$_SESSION[EW_SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$sSuccessMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sSuccessMessage, "success");
		if ($sSuccessMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sSuccessMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sSuccessMessage;
			$html .= "<div class=\"alert alert-success ewSuccess\">" . $sSuccessMessage . "</div>";
			$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$sErrorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sErrorMessage, "failure");
		if ($sErrorMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sErrorMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sErrorMessage;
			$html .= "<div class=\"alert alert-danger ewError\">" . $sErrorMessage . "</div>";
			$_SESSION[EW_SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo "<div class=\"ewMessageDialog\"" . (($hidden) ? " style=\"display: none;\"" : "") . ">" . $html . "</div>";
	}
	var $PageHeader;
	var $PageFooter;

	// Show Page Header
	function ShowPageHeader() {
		$sHeader = $this->PageHeader;
		$this->Page_DataRendering($sHeader);
		if ($sHeader <> "") { // Header exists, display
			echo "<p>" . $sHeader . "</p>";
		}
	}

	// Show Page Footer
	function ShowPageFooter() {
		$sFooter = $this->PageFooter;
		$this->Page_DataRendered($sFooter);
		if ($sFooter <> "") { // Footer exists, display
			echo "<p>" . $sFooter . "</p>";
		}
	}

	// Validate page request
	function IsPageRequest() {
		global $objForm;
		if ($this->UseTokenInUrl) {
			if ($objForm)
				return ($this->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($this->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}
	var $Token = "";
	var $TokenTimeout = 0;
	var $CheckToken = EW_CHECK_TOKEN;
	var $CheckTokenFn = "ew_CheckToken";
	var $CreateTokenFn = "ew_CreateToken";

	// Valid Post
	function ValidPost() {
		if (!$this->CheckToken || !ew_IsHttpPost())
			return TRUE;
		if (!isset($_POST[EW_TOKEN_NAME]))
			return FALSE;
		$fn = $this->CheckTokenFn;
		if (is_callable($fn))
			return $fn($_POST[EW_TOKEN_NAME], $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	function CreateToken() {
		global $gsToken;
		if ($this->CheckToken) {
			$fn = $this->CreateTokenFn;
			if ($this->Token == "" && is_callable($fn)) // Create token
				$this->Token = $fn();
			$gsToken = $this->Token; // Save to global variable
		}
	}

	//
	// Page class constructor
	//
	function __construct() {
		global $conn, $Language;
		global $UserTable, $UserTableConn;
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = ew_SessionTimeoutTime();

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Parent constuctor
		parent::__construct();

		// Table object (t03_pinjaman)
		if (!isset($GLOBALS["t03_pinjaman"]) || get_class($GLOBALS["t03_pinjaman"]) == "ct03_pinjaman") {
			$GLOBALS["t03_pinjaman"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t03_pinjaman"];
		}

		// Table object (t96_employees)
		if (!isset($GLOBALS['t96_employees'])) $GLOBALS['t96_employees'] = new ct96_employees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 't03_pinjaman', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

		// Open connection
		if (!isset($conn)) $conn = ew_Connect($this->DBID);

		// User table object (t96_employees)
		if (!isset($UserTable)) {
			$UserTable = new ct96_employees();
			$UserTableConn = Conn($UserTable->DBID);
		}
	}

	//
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsCustomExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if ($Security->IsLoggedIn()) $Security->TablePermission_Loading();
		$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName);
		if ($Security->IsLoggedIn()) $Security->TablePermission_Loaded();
		if (!$Security->CanDelete()) {
			$Security->SaveLastUrl();
			$this->setFailureMessage(ew_DeniedMsg()); // Set no permission
			if ($Security->CanList())
				$this->Page_Terminate(ew_GetUrl("t03_pinjamanlist.php"));
			else
				$this->Page_Terminate(ew_GetUrl("login.php"));
		}
		if ($Security->IsLoggedIn()) {
			$Security->UserID_Loading();
			$Security->LoadUserID();
			$Security->UserID_Loaded();
		}
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action
		$this->id->SetVisibility();
		$this->id->Visible = !$this->IsAdd() && !$this->IsCopy() && !$this->IsGridAdd();
		$this->Kontrak_No->SetVisibility();
		$this->Kontrak_Tgl->SetVisibility();
		$this->nasabah_id->SetVisibility();
		$this->Pinjaman->SetVisibility();
		$this->Angsuran_Lama->SetVisibility();
		$this->Angsuran_Bunga_Prosen->SetVisibility();
		$this->Angsuran_Denda->SetVisibility();
		$this->Dispensasi_Denda->SetVisibility();
		$this->Angsuran_Pokok->SetVisibility();
		$this->Angsuran_Bunga->SetVisibility();
		$this->Angsuran_Total->SetVisibility();
		$this->No_Ref->SetVisibility();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->ValidPost()) {
			echo $Language->Phrase("InvalidPostRequest");
			$this->Page_Terminate();
			exit();
		}

		// Create Token
		$this->CreateToken();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $gsExportFile, $gTmpImages;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $EW_EXPORT, $t03_pinjaman;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($t03_pinjaman);
				$doc->Text = $sContent;
				if ($this->Export == "email")
					echo $this->ExportEmail($doc->Text);
				else
					$doc->Export();
				ew_DeleteTmpImages(); // Delete temp images
				exit();
			}
		}
		$this->Page_Redirecting($url);

		 // Close connection
		ew_CloseConn();

		// Go to URL if specified
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			header("Location: " . $url);
		}
		exit();
	}
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $StartRec;
	var $TotalRecs = 0;
	var $RecCnt;
	var $RecKeys = array();
	var $Recordset;
	var $StartRowCnt = 1;
	var $RowCnt = 0;

	//
	// Page main
	//
	function Page_Main() {
		global $Language;

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Load key parameters
		$this->RecKeys = $this->GetRecordKeys(); // Load record keys
		$sFilter = $this->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("t03_pinjamanlist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in t03_pinjaman class, t03_pinjamaninfo.php

		$this->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$this->CurrentAction = $_POST["a_delete"];
		} elseif (@$_GET["a_delete"] == "1") {
			$this->CurrentAction = "D"; // Delete record directly
		} else {
			$this->CurrentAction = "I"; // Display record
		}
		if ($this->CurrentAction == "D") {
			$this->SendEmail = TRUE; // Send email on delete success
			if ($this->DeleteRows()) { // Delete rows
				if ($this->getSuccessMessage() == "")
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
				$this->Page_Terminate($this->getReturnUrl()); // Return to caller
			} else { // Delete failed
				$this->CurrentAction = "I"; // Display record
			}
		}
		if ($this->CurrentAction == "I") { // Load records for display
			if ($this->Recordset = $this->LoadRecordset())
				$this->TotalRecs = $this->Recordset->RecordCount(); // Get record count
			if ($this->TotalRecs <= 0) { // No record found, exit
				if ($this->Recordset)
					$this->Recordset->Close();
				$this->Page_Terminate("t03_pinjamanlist.php"); // Return to list
			}
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {

		// Load List page SQL
		$sSql = $this->SelectSQL();
		$conn = &$this->Connection();

		// Load recordset
		$dbtype = ew_GetConnectionType($this->DBID);
		if ($this->UseSelectLimit) {
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			if ($dbtype == "MSSQL") {
				$rs = $conn->SelectLimit($sSql, $rowcnt, $offset, array("_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderBy())));
			} else {
				$rs = $conn->SelectLimit($sSql, $rowcnt, $offset);
			}
			$conn->raiseErrorFn = '';
		} else {
			$rs = ew_LoadRecordset($sSql, $conn);
		}

		// Call Recordset Selected event
		$this->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $Security, $Language;
		$sFilter = $this->KeyFilter();

		// Call Row Selecting event
		$this->Row_Selecting($sFilter);

		// Load SQL based on filter
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		$conn = &$this->Connection();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row = &$rs->fields;
		$this->Row_Selected($row);
		$this->id->setDbValue($rs->fields('id'));
		$this->Kontrak_No->setDbValue($rs->fields('Kontrak_No'));
		$this->Kontrak_Tgl->setDbValue($rs->fields('Kontrak_Tgl'));
		$this->nasabah_id->setDbValue($rs->fields('nasabah_id'));
		$this->Pinjaman->setDbValue($rs->fields('Pinjaman'));
		$this->Angsuran_Lama->setDbValue($rs->fields('Angsuran_Lama'));
		$this->Angsuran_Bunga_Prosen->setDbValue($rs->fields('Angsuran_Bunga_Prosen'));
		$this->Angsuran_Denda->setDbValue($rs->fields('Angsuran_Denda'));
		$this->Dispensasi_Denda->setDbValue($rs->fields('Dispensasi_Denda'));
		$this->Angsuran_Pokok->setDbValue($rs->fields('Angsuran_Pokok'));
		$this->Angsuran_Bunga->setDbValue($rs->fields('Angsuran_Bunga'));
		$this->Angsuran_Total->setDbValue($rs->fields('Angsuran_Total'));
		$this->No_Ref->setDbValue($rs->fields('No_Ref'));
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->Kontrak_No->DbValue = $row['Kontrak_No'];
		$this->Kontrak_Tgl->DbValue = $row['Kontrak_Tgl'];
		$this->nasabah_id->DbValue = $row['nasabah_id'];
		$this->Pinjaman->DbValue = $row['Pinjaman'];
		$this->Angsuran_Lama->DbValue = $row['Angsuran_Lama'];
		$this->Angsuran_Bunga_Prosen->DbValue = $row['Angsuran_Bunga_Prosen'];
		$this->Angsuran_Denda->DbValue = $row['Angsuran_Denda'];
		$this->Dispensasi_Denda->DbValue = $row['Dispensasi_Denda'];
		$this->Angsuran_Pokok->DbValue = $row['Angsuran_Pokok'];
		$this->Angsuran_Bunga->DbValue = $row['Angsuran_Bunga'];
		$this->Angsuran_Total->DbValue = $row['Angsuran_Total'];
		$this->No_Ref->DbValue = $row['No_Ref'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Convert decimal values if posted back

		if ($this->Pinjaman->FormValue == $this->Pinjaman->CurrentValue && is_numeric(ew_StrToFloat($this->Pinjaman->CurrentValue)))
			$this->Pinjaman->CurrentValue = ew_StrToFloat($this->Pinjaman->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Angsuran_Bunga_Prosen->FormValue == $this->Angsuran_Bunga_Prosen->CurrentValue && is_numeric(ew_StrToFloat($this->Angsuran_Bunga_Prosen->CurrentValue)))
			$this->Angsuran_Bunga_Prosen->CurrentValue = ew_StrToFloat($this->Angsuran_Bunga_Prosen->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Angsuran_Denda->FormValue == $this->Angsuran_Denda->CurrentValue && is_numeric(ew_StrToFloat($this->Angsuran_Denda->CurrentValue)))
			$this->Angsuran_Denda->CurrentValue = ew_StrToFloat($this->Angsuran_Denda->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Angsuran_Pokok->FormValue == $this->Angsuran_Pokok->CurrentValue && is_numeric(ew_StrToFloat($this->Angsuran_Pokok->CurrentValue)))
			$this->Angsuran_Pokok->CurrentValue = ew_StrToFloat($this->Angsuran_Pokok->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Angsuran_Bunga->FormValue == $this->Angsuran_Bunga->CurrentValue && is_numeric(ew_StrToFloat($this->Angsuran_Bunga->CurrentValue)))
			$this->Angsuran_Bunga->CurrentValue = ew_StrToFloat($this->Angsuran_Bunga->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Angsuran_Total->FormValue == $this->Angsuran_Total->CurrentValue && is_numeric(ew_StrToFloat($this->Angsuran_Total->CurrentValue)))
			$this->Angsuran_Total->CurrentValue = ew_StrToFloat($this->Angsuran_Total->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// id
		// Kontrak_No
		// Kontrak_Tgl
		// nasabah_id
		// Pinjaman
		// Angsuran_Lama
		// Angsuran_Bunga_Prosen
		// Angsuran_Denda
		// Dispensasi_Denda
		// Angsuran_Pokok
		// Angsuran_Bunga
		// Angsuran_Total
		// No_Ref

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// Kontrak_No
		$this->Kontrak_No->ViewValue = $this->Kontrak_No->CurrentValue;
		$this->Kontrak_No->ViewCustomAttributes = "";

		// Kontrak_Tgl
		$this->Kontrak_Tgl->ViewValue = $this->Kontrak_Tgl->CurrentValue;
		$this->Kontrak_Tgl->ViewValue = ew_FormatDateTime($this->Kontrak_Tgl->ViewValue, 0);
		$this->Kontrak_Tgl->ViewCustomAttributes = "";

		// nasabah_id
		$this->nasabah_id->ViewValue = $this->nasabah_id->CurrentValue;
		$this->nasabah_id->ViewCustomAttributes = "";

		// Pinjaman
		$this->Pinjaman->ViewValue = $this->Pinjaman->CurrentValue;
		$this->Pinjaman->ViewCustomAttributes = "";

		// Angsuran_Lama
		$this->Angsuran_Lama->ViewValue = $this->Angsuran_Lama->CurrentValue;
		$this->Angsuran_Lama->ViewCustomAttributes = "";

		// Angsuran_Bunga_Prosen
		$this->Angsuran_Bunga_Prosen->ViewValue = $this->Angsuran_Bunga_Prosen->CurrentValue;
		$this->Angsuran_Bunga_Prosen->ViewCustomAttributes = "";

		// Angsuran_Denda
		$this->Angsuran_Denda->ViewValue = $this->Angsuran_Denda->CurrentValue;
		$this->Angsuran_Denda->ViewCustomAttributes = "";

		// Dispensasi_Denda
		$this->Dispensasi_Denda->ViewValue = $this->Dispensasi_Denda->CurrentValue;
		$this->Dispensasi_Denda->ViewCustomAttributes = "";

		// Angsuran_Pokok
		$this->Angsuran_Pokok->ViewValue = $this->Angsuran_Pokok->CurrentValue;
		$this->Angsuran_Pokok->ViewCustomAttributes = "";

		// Angsuran_Bunga
		$this->Angsuran_Bunga->ViewValue = $this->Angsuran_Bunga->CurrentValue;
		$this->Angsuran_Bunga->ViewCustomAttributes = "";

		// Angsuran_Total
		$this->Angsuran_Total->ViewValue = $this->Angsuran_Total->CurrentValue;
		$this->Angsuran_Total->ViewCustomAttributes = "";

		// No_Ref
		$this->No_Ref->ViewValue = $this->No_Ref->CurrentValue;
		$this->No_Ref->ViewCustomAttributes = "";

			// id
			$this->id->LinkCustomAttributes = "";
			$this->id->HrefValue = "";
			$this->id->TooltipValue = "";

			// Kontrak_No
			$this->Kontrak_No->LinkCustomAttributes = "";
			$this->Kontrak_No->HrefValue = "";
			$this->Kontrak_No->TooltipValue = "";

			// Kontrak_Tgl
			$this->Kontrak_Tgl->LinkCustomAttributes = "";
			$this->Kontrak_Tgl->HrefValue = "";
			$this->Kontrak_Tgl->TooltipValue = "";

			// nasabah_id
			$this->nasabah_id->LinkCustomAttributes = "";
			$this->nasabah_id->HrefValue = "";
			$this->nasabah_id->TooltipValue = "";

			// Pinjaman
			$this->Pinjaman->LinkCustomAttributes = "";
			$this->Pinjaman->HrefValue = "";
			$this->Pinjaman->TooltipValue = "";

			// Angsuran_Lama
			$this->Angsuran_Lama->LinkCustomAttributes = "";
			$this->Angsuran_Lama->HrefValue = "";
			$this->Angsuran_Lama->TooltipValue = "";

			// Angsuran_Bunga_Prosen
			$this->Angsuran_Bunga_Prosen->LinkCustomAttributes = "";
			$this->Angsuran_Bunga_Prosen->HrefValue = "";
			$this->Angsuran_Bunga_Prosen->TooltipValue = "";

			// Angsuran_Denda
			$this->Angsuran_Denda->LinkCustomAttributes = "";
			$this->Angsuran_Denda->HrefValue = "";
			$this->Angsuran_Denda->TooltipValue = "";

			// Dispensasi_Denda
			$this->Dispensasi_Denda->LinkCustomAttributes = "";
			$this->Dispensasi_Denda->HrefValue = "";
			$this->Dispensasi_Denda->TooltipValue = "";

			// Angsuran_Pokok
			$this->Angsuran_Pokok->LinkCustomAttributes = "";
			$this->Angsuran_Pokok->HrefValue = "";
			$this->Angsuran_Pokok->TooltipValue = "";

			// Angsuran_Bunga
			$this->Angsuran_Bunga->LinkCustomAttributes = "";
			$this->Angsuran_Bunga->HrefValue = "";
			$this->Angsuran_Bunga->TooltipValue = "";

			// Angsuran_Total
			$this->Angsuran_Total->LinkCustomAttributes = "";
			$this->Angsuran_Total->HrefValue = "";
			$this->Angsuran_Total->TooltipValue = "";

			// No_Ref
			$this->No_Ref->LinkCustomAttributes = "";
			$this->No_Ref->HrefValue = "";
			$this->No_Ref->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $Language, $Security;
		if (!$Security->CanDelete()) {
			$this->setFailureMessage($Language->Phrase("NoDeletePermission")); // No delete permission
			return FALSE;
		}
		$DeleteRows = TRUE;
		$sSql = $this->SQL();
		$conn = &$this->Connection();
		$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
			$rs->Close();
			return FALSE;

		//} else {
		//	$this->LoadRowValues($rs); // Load row values

		}
		$rows = ($rs) ? $rs->GetRows() : array();
		$conn->BeginTrans();
		if ($this->AuditTrailOnDelete) $this->WriteAuditTrailDummy($Language->Phrase("BatchDeleteBegin")); // Batch delete begin

		// Clone old rows
		$rsold = $rows;
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $this->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
				$sThisKey .= $row['id'];
				$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
				$DeleteRows = $this->Delete($row); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage <> "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($DeleteRows) {
			$conn->CommitTrans(); // Commit the changes
			if ($this->AuditTrailOnDelete) $this->WriteAuditTrailDummy($Language->Phrase("BatchDeleteSuccess")); // Batch delete success
		} else {
			$conn->RollbackTrans(); // Rollback changes
			if ($this->AuditTrailOnDelete) $this->WriteAuditTrailDummy($Language->Phrase("BatchDeleteRollback")); // Batch delete rollback
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$this->Row_Deleted($row);
			}
		}
		return $DeleteRows;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("t03_pinjamanlist.php"), "", $this->TableVar, TRUE);
		$PageId = "delete";
		$Breadcrumb->Add("delete", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		}
	}

	// Setup AutoSuggest filters of a field
	function SetupAutoSuggestFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($t03_pinjaman_delete)) $t03_pinjaman_delete = new ct03_pinjaman_delete();

// Page init
$t03_pinjaman_delete->Page_Init();

// Page main
$t03_pinjaman_delete->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t03_pinjaman_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "delete";
var CurrentForm = ft03_pinjamandelete = new ew_Form("ft03_pinjamandelete", "delete");

// Form_CustomValidate event
ft03_pinjamandelete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft03_pinjamandelete.ValidateRequired = true;
<?php } else { ?>
ft03_pinjamandelete.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
// Form object for search

</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<div class="ewToolbar">
<?php $Breadcrumb->Render(); ?>
<?php echo $Language->SelectionForm(); ?>
<div class="clearfix"></div>
</div>
<?php $t03_pinjaman_delete->ShowPageHeader(); ?>
<?php
$t03_pinjaman_delete->ShowMessage();
?>
<form name="ft03_pinjamandelete" id="ft03_pinjamandelete" class="form-inline ewForm ewDeleteForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($t03_pinjaman_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $t03_pinjaman_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t03_pinjaman">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($t03_pinjaman_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="ewGrid">
<div class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<table class="table ewTable">
<?php echo $t03_pinjaman->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
<?php if ($t03_pinjaman->id->Visible) { // id ?>
		<th><span id="elh_t03_pinjaman_id" class="t03_pinjaman_id"><?php echo $t03_pinjaman->id->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t03_pinjaman->Kontrak_No->Visible) { // Kontrak_No ?>
		<th><span id="elh_t03_pinjaman_Kontrak_No" class="t03_pinjaman_Kontrak_No"><?php echo $t03_pinjaman->Kontrak_No->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t03_pinjaman->Kontrak_Tgl->Visible) { // Kontrak_Tgl ?>
		<th><span id="elh_t03_pinjaman_Kontrak_Tgl" class="t03_pinjaman_Kontrak_Tgl"><?php echo $t03_pinjaman->Kontrak_Tgl->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t03_pinjaman->nasabah_id->Visible) { // nasabah_id ?>
		<th><span id="elh_t03_pinjaman_nasabah_id" class="t03_pinjaman_nasabah_id"><?php echo $t03_pinjaman->nasabah_id->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t03_pinjaman->Pinjaman->Visible) { // Pinjaman ?>
		<th><span id="elh_t03_pinjaman_Pinjaman" class="t03_pinjaman_Pinjaman"><?php echo $t03_pinjaman->Pinjaman->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t03_pinjaman->Angsuran_Lama->Visible) { // Angsuran_Lama ?>
		<th><span id="elh_t03_pinjaman_Angsuran_Lama" class="t03_pinjaman_Angsuran_Lama"><?php echo $t03_pinjaman->Angsuran_Lama->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t03_pinjaman->Angsuran_Bunga_Prosen->Visible) { // Angsuran_Bunga_Prosen ?>
		<th><span id="elh_t03_pinjaman_Angsuran_Bunga_Prosen" class="t03_pinjaman_Angsuran_Bunga_Prosen"><?php echo $t03_pinjaman->Angsuran_Bunga_Prosen->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t03_pinjaman->Angsuran_Denda->Visible) { // Angsuran_Denda ?>
		<th><span id="elh_t03_pinjaman_Angsuran_Denda" class="t03_pinjaman_Angsuran_Denda"><?php echo $t03_pinjaman->Angsuran_Denda->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t03_pinjaman->Dispensasi_Denda->Visible) { // Dispensasi_Denda ?>
		<th><span id="elh_t03_pinjaman_Dispensasi_Denda" class="t03_pinjaman_Dispensasi_Denda"><?php echo $t03_pinjaman->Dispensasi_Denda->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t03_pinjaman->Angsuran_Pokok->Visible) { // Angsuran_Pokok ?>
		<th><span id="elh_t03_pinjaman_Angsuran_Pokok" class="t03_pinjaman_Angsuran_Pokok"><?php echo $t03_pinjaman->Angsuran_Pokok->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t03_pinjaman->Angsuran_Bunga->Visible) { // Angsuran_Bunga ?>
		<th><span id="elh_t03_pinjaman_Angsuran_Bunga" class="t03_pinjaman_Angsuran_Bunga"><?php echo $t03_pinjaman->Angsuran_Bunga->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t03_pinjaman->Angsuran_Total->Visible) { // Angsuran_Total ?>
		<th><span id="elh_t03_pinjaman_Angsuran_Total" class="t03_pinjaman_Angsuran_Total"><?php echo $t03_pinjaman->Angsuran_Total->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t03_pinjaman->No_Ref->Visible) { // No_Ref ?>
		<th><span id="elh_t03_pinjaman_No_Ref" class="t03_pinjaman_No_Ref"><?php echo $t03_pinjaman->No_Ref->FldCaption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$t03_pinjaman_delete->RecCnt = 0;
$i = 0;
while (!$t03_pinjaman_delete->Recordset->EOF) {
	$t03_pinjaman_delete->RecCnt++;
	$t03_pinjaman_delete->RowCnt++;

	// Set row properties
	$t03_pinjaman->ResetAttrs();
	$t03_pinjaman->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$t03_pinjaman_delete->LoadRowValues($t03_pinjaman_delete->Recordset);

	// Render row
	$t03_pinjaman_delete->RenderRow();
?>
	<tr<?php echo $t03_pinjaman->RowAttributes() ?>>
<?php if ($t03_pinjaman->id->Visible) { // id ?>
		<td<?php echo $t03_pinjaman->id->CellAttributes() ?>>
<span id="el<?php echo $t03_pinjaman_delete->RowCnt ?>_t03_pinjaman_id" class="t03_pinjaman_id">
<span<?php echo $t03_pinjaman->id->ViewAttributes() ?>>
<?php echo $t03_pinjaman->id->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t03_pinjaman->Kontrak_No->Visible) { // Kontrak_No ?>
		<td<?php echo $t03_pinjaman->Kontrak_No->CellAttributes() ?>>
<span id="el<?php echo $t03_pinjaman_delete->RowCnt ?>_t03_pinjaman_Kontrak_No" class="t03_pinjaman_Kontrak_No">
<span<?php echo $t03_pinjaman->Kontrak_No->ViewAttributes() ?>>
<?php echo $t03_pinjaman->Kontrak_No->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t03_pinjaman->Kontrak_Tgl->Visible) { // Kontrak_Tgl ?>
		<td<?php echo $t03_pinjaman->Kontrak_Tgl->CellAttributes() ?>>
<span id="el<?php echo $t03_pinjaman_delete->RowCnt ?>_t03_pinjaman_Kontrak_Tgl" class="t03_pinjaman_Kontrak_Tgl">
<span<?php echo $t03_pinjaman->Kontrak_Tgl->ViewAttributes() ?>>
<?php echo $t03_pinjaman->Kontrak_Tgl->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t03_pinjaman->nasabah_id->Visible) { // nasabah_id ?>
		<td<?php echo $t03_pinjaman->nasabah_id->CellAttributes() ?>>
<span id="el<?php echo $t03_pinjaman_delete->RowCnt ?>_t03_pinjaman_nasabah_id" class="t03_pinjaman_nasabah_id">
<span<?php echo $t03_pinjaman->nasabah_id->ViewAttributes() ?>>
<?php echo $t03_pinjaman->nasabah_id->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t03_pinjaman->Pinjaman->Visible) { // Pinjaman ?>
		<td<?php echo $t03_pinjaman->Pinjaman->CellAttributes() ?>>
<span id="el<?php echo $t03_pinjaman_delete->RowCnt ?>_t03_pinjaman_Pinjaman" class="t03_pinjaman_Pinjaman">
<span<?php echo $t03_pinjaman->Pinjaman->ViewAttributes() ?>>
<?php echo $t03_pinjaman->Pinjaman->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t03_pinjaman->Angsuran_Lama->Visible) { // Angsuran_Lama ?>
		<td<?php echo $t03_pinjaman->Angsuran_Lama->CellAttributes() ?>>
<span id="el<?php echo $t03_pinjaman_delete->RowCnt ?>_t03_pinjaman_Angsuran_Lama" class="t03_pinjaman_Angsuran_Lama">
<span<?php echo $t03_pinjaman->Angsuran_Lama->ViewAttributes() ?>>
<?php echo $t03_pinjaman->Angsuran_Lama->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t03_pinjaman->Angsuran_Bunga_Prosen->Visible) { // Angsuran_Bunga_Prosen ?>
		<td<?php echo $t03_pinjaman->Angsuran_Bunga_Prosen->CellAttributes() ?>>
<span id="el<?php echo $t03_pinjaman_delete->RowCnt ?>_t03_pinjaman_Angsuran_Bunga_Prosen" class="t03_pinjaman_Angsuran_Bunga_Prosen">
<span<?php echo $t03_pinjaman->Angsuran_Bunga_Prosen->ViewAttributes() ?>>
<?php echo $t03_pinjaman->Angsuran_Bunga_Prosen->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t03_pinjaman->Angsuran_Denda->Visible) { // Angsuran_Denda ?>
		<td<?php echo $t03_pinjaman->Angsuran_Denda->CellAttributes() ?>>
<span id="el<?php echo $t03_pinjaman_delete->RowCnt ?>_t03_pinjaman_Angsuran_Denda" class="t03_pinjaman_Angsuran_Denda">
<span<?php echo $t03_pinjaman->Angsuran_Denda->ViewAttributes() ?>>
<?php echo $t03_pinjaman->Angsuran_Denda->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t03_pinjaman->Dispensasi_Denda->Visible) { // Dispensasi_Denda ?>
		<td<?php echo $t03_pinjaman->Dispensasi_Denda->CellAttributes() ?>>
<span id="el<?php echo $t03_pinjaman_delete->RowCnt ?>_t03_pinjaman_Dispensasi_Denda" class="t03_pinjaman_Dispensasi_Denda">
<span<?php echo $t03_pinjaman->Dispensasi_Denda->ViewAttributes() ?>>
<?php echo $t03_pinjaman->Dispensasi_Denda->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t03_pinjaman->Angsuran_Pokok->Visible) { // Angsuran_Pokok ?>
		<td<?php echo $t03_pinjaman->Angsuran_Pokok->CellAttributes() ?>>
<span id="el<?php echo $t03_pinjaman_delete->RowCnt ?>_t03_pinjaman_Angsuran_Pokok" class="t03_pinjaman_Angsuran_Pokok">
<span<?php echo $t03_pinjaman->Angsuran_Pokok->ViewAttributes() ?>>
<?php echo $t03_pinjaman->Angsuran_Pokok->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t03_pinjaman->Angsuran_Bunga->Visible) { // Angsuran_Bunga ?>
		<td<?php echo $t03_pinjaman->Angsuran_Bunga->CellAttributes() ?>>
<span id="el<?php echo $t03_pinjaman_delete->RowCnt ?>_t03_pinjaman_Angsuran_Bunga" class="t03_pinjaman_Angsuran_Bunga">
<span<?php echo $t03_pinjaman->Angsuran_Bunga->ViewAttributes() ?>>
<?php echo $t03_pinjaman->Angsuran_Bunga->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t03_pinjaman->Angsuran_Total->Visible) { // Angsuran_Total ?>
		<td<?php echo $t03_pinjaman->Angsuran_Total->CellAttributes() ?>>
<span id="el<?php echo $t03_pinjaman_delete->RowCnt ?>_t03_pinjaman_Angsuran_Total" class="t03_pinjaman_Angsuran_Total">
<span<?php echo $t03_pinjaman->Angsuran_Total->ViewAttributes() ?>>
<?php echo $t03_pinjaman->Angsuran_Total->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t03_pinjaman->No_Ref->Visible) { // No_Ref ?>
		<td<?php echo $t03_pinjaman->No_Ref->CellAttributes() ?>>
<span id="el<?php echo $t03_pinjaman_delete->RowCnt ?>_t03_pinjaman_No_Ref" class="t03_pinjaman_No_Ref">
<span<?php echo $t03_pinjaman->No_Ref->ViewAttributes() ?>>
<?php echo $t03_pinjaman->No_Ref->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$t03_pinjaman_delete->Recordset->MoveNext();
}
$t03_pinjaman_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $t03_pinjaman_delete->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
</div>
</form>
<script type="text/javascript">
ft03_pinjamandelete.Init();
</script>
<?php
$t03_pinjaman_delete->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$t03_pinjaman_delete->Page_Terminate();
?>
