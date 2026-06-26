\# ML-Laravel Integration Contract



\## predict\_employment\_type.py



\### Input (command-line argument)



JSON string with these required keys:



\- age (int)

\- sex (string: Male, Female)

\- civil\_status (string)

\- disability\_type (string)

\- disability\_visibility (string: Apparent, Non-apparent)

\- cause\_of\_disability (string)

\- educational\_attainment (string)

\- skills (string)

\- mobility\_status (string)

\- current\_assistive\_device (string, use "None" if no device)

\- occupation\_group (string)



\### Output (stdout)



JSON with:



\- predicted\_type (string)

\- confidence (float, 0.0-1.0)

\- all\_probabilities (object, class\_name -> probability)



\### Error responses



```json

{

&#x20; "error": "<error message>"

}

