<?php
/*
 * Copyright 2007-2016 Charles du Jeu - Abstrium SAS <team (at) pyd.io>
 * This file is part of Pydio.
 *
 * Pydio is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Pydio is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with Pydio.  If not, see <http://www.gnu.org/licenses/>.
 *
 * The latest code can be found at <http://pyd.io/>.
 *
 */
namespace AccessS3;
use Aws\S3\S3Client as AwsS3Client;
use Aws\S3\StreamWrapper;
require_once __DIR__ . DIRECTORY_SEPARATOR . "class.s3CacheService.php";
defined('AJXP_EXEC') or die( 'Access not allowed');

/**
 * Class S3Client
 * @package AccessS3
 */
class S3Client extends AwsS3Client
{
    /**
     * Register a new stream wrapper who overwrite the Amazon S3 stream wrapper with this client instance.
     * @param string $repositoryId
     * @return $this|void
     */
    public function registerStreamWrapper($repositoryId)
    {
        /* S3Client + s3 protocol +  cacheInterface */
        StreamWrapper::register($this, "s3.".$repositoryId, new s3CacheService());
    }
}