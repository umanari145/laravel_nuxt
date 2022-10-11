#!/bin/bash
aws configure set aws_access_key_id dummy
aws configure set aws_secret_access_key dummy
aws configure set default.region ap-northeast-1
aws s3 mb s3://sample \
    --endpoint-url=http://localstack:4566