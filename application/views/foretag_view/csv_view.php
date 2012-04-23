    <table cellpadding="0" cellspacing="0">  
        <thead>  
        <th>  
                <td>PRODUCT ID</td>  
                <td>PRODUCT NAME</td>  
                <td>CATEGORY</td>  
                <td>PRICE</td>  
        </th>  
        </thead>  
      
        <tbody>  
                <?php foreach($csvData as $field){?>  
                    <tr>  
                        <td><?=$field['id']?></td>  
                       <td><?=$field['name']?></td>  
                        <td><?=$field['category']?></td>  
                        <td><?=$field['price']?></td>  
                    </tr>  
                <?php }?>  
        </tbody>  
      
    </table>  