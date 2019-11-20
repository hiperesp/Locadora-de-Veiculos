<?php
interface InstallerConstants {
    const INSTALLED_SUCCESSFULLY = 0;
    const INSTALLED_WRITE_ERROR = 1;
    const NOT_INSTALLED_PDO_EXCEPTION = 2;
    const NOT_INSTALLED_UNKNOWN_DATABASE = 3;
}