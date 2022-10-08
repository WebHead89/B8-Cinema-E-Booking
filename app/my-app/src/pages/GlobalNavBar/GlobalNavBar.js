import AppBar from '@mui/material/AppBar';
import ToolBar from '@mui/material/Toolbar'
import Autocomplete, { createFilterOptions } from '@mui/material/Autocomplete';
import TextField from '@mui/material/TextField';
import Typography from '@mui/material/Typography'
import Box from '@mui/material/Box'
import AccountCircleIcon from '@mui/icons-material/AccountCircle';
import Button from '@mui/material/Button';
import Menu from '@mui/material/Menu';
import MenuItem from '@mui/material/MenuItem';

import React, { useState, MouseEvent } from 'react';


const GlobalNavBar = () => {


    const [anchorEl, setAnchorEl] = useState(null)
    const open = Boolean(anchorEl);

    const handleClick = (event) => {
        setAnchorEl(event.currentTarget);
    };
    const handleClose = () => {
        setAnchorEl(null);
    };

    const handleLogin = () => { }
    const handleSignup = () => { }


    return (
        <Box sx={{ flexGrow: 1 }}>
            <AppBar position='static'>
                <ToolBar>
                    <Box sx={{ flexGrow: 1, flexDirection: 'row', alignItems: 'center', justifyContent: 'flex-start', display: 'flex' }}>
                    <Typography variant="h6" component="div" >
                        E-Booking Cinema
                    </Typography>
                    <Typography variant="h7" component="div" sx={{ display: 'flex', m: 4}}>
                        Home
                    </Typography>  
                    <Typography variant="h7" component="div" sx={{display: 'flex', m: 2}}>
                        View Cart
                    </Typography>
                    </Box>
                    <Autocomplete
                        freeSolo id="auto-movie-search"
                        options={movieList.map((option) => option.title)} // This should pull from a database instead I guess?
                        renderInput={(params) => <TextField {...params} variant='outlined' sx={{ outlineColor: 'white', input: { color: 'white' } }} label="Search for movies"   InputLabelProps={{
                            style: { color: 'white', borderColor: 'white' },
                          }}/>}
                        sx={{ minWidth: 200, mr: 10, borderColor: 'white'}}
                    />
                    <AccountCircleIcon 
                    // onClick={handleClick} sx={{
                    //     "&:hover": {
                    //         backgroundColor: "transparent",
                    //         cursor: "pointer"
                    //     }
                    // }} 
                    />
                    <Button id='navbar-account' sx={{ color: 'white', display: 'block' }} onClick={handleClick}>
                        Account
                    </Button>
                    <Menu id="basic-menu"
                        anchorEl={anchorEl}
                        open={open}
                        onClose={handleClose}
                        MenuListProps={{
                            'aria-labelledby': 'basic-button',
                        }}>
                        {/* Want to add if logged in, show logged in menu. Else show this temp menu implemented here */}
                        <MenuItem onClick={handleClose}>Log In</MenuItem>
                        <MenuItem onClick={handleClose}>Sign Up</MenuItem>
                    </Menu>
                </ToolBar>
            </AppBar>
        </Box>
    )
}

// This should pull from a database instead I guess?
const movieList = [
    { title: 'avatar' },
    { title: 'top gun' },
    { title: 'avengers' }
]

export default GlobalNavBar