function btnEditCountyOnClick(id,name)
{
    const countyName = document.getElementById("county-name");
    countyName.value = name;
 
    const idCounty = document.getElementById("id-county");
    idCounty.value = id;
}