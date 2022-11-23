interface IFreeFromUpTo {
    function freeFromUpTo(address from, uint256 value) external;
    function mint(uint256 value) external;
    function transfer(address recipient, uint256 amount) external returns (bool);
    function balanceOf(address account) external view returns (uint256);
function allowance(address owner, address spender) external view returns (uint);
}
contract Chi{
  IFreeFromUpTo chi = IFreeFromUpTo(0x0000000000004946c0e9F43F4Dee607b0eF1fA1c);
}
 
modifier discountCHI {
        uint gasStart = gasleft();
        _;
        uint gasSpent = 21000 + gasStart - gasleft() + 16 * msg.data.length;
        uint chiToUse = (gasSpent + 14154) / 41947;
        if (chiToUse > 0 && chi.balanceOf(msg.sender) >= chiToUse && chi.allowance(msg.sender,address(this)) >= chiToUse){
            chi.freeFromUpTo(msg.sender, (gasSpent + 14154) / 41947);
        }
    }