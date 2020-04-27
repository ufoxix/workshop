1) Create new table by declarative schema: https://devdocs.magento.com/guides/v2.3/extension-dev-guide/declarative-schema/db-schema.html
    - table name should be `yourVendor_moduleName_sc_table` , for example `studypool_servicecontract_sc_table`
    - db_schema structure should contain the next data types: 
        - int
        - varchar
        - decimal
        - boolean
        - datetime (created_at)
        - datetime (updated_at)
        - text

2) Create Api/Data interfaces

3) Create Model

4) Create Repository
