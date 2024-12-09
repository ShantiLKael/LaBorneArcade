<?php

/**
 * The goal of this file is to allow developers a location
 * where they can overwrite core procedural functions and
 * replace them with their own. This file is loaded during
 * the bootstrap process and is called during the framework's
 * execution.
 *
 * This can be looked at as a `master helper` file that is
 * loaded early on, and may also contain additional functions
 * that you'd like to use throughout your entire application
 *
 * @see: https://codeigniter.com/user_guide/extending/common.html
 */

/**
 * @param string|bool|int $value
 * @return int
 * @throws Exception
 */
function parse_bool_to_postgres(string|bool|int $value): int {
	if ($value === "true" || $value === 1 || $value === true)
		return 1;
	if ($value === "false" || $value === 0 || $value === false)
		return 0;
	throw new Exception("Unsupported boolean value for Postgres: '$value'");
}
